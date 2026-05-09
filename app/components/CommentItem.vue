<template>
  <div :class="{ 'ml-8 border-l border-zinc-700 pl-6' : comment.parent_id }">
    <div class="bg-zinc-900 rounded-3xl p-6">
      <div class="flex justify-between">
        <div>
          <span class="font-semibold">{{ comment.author_name }}</span>
          <span class="text-xs text-zinc-500 ml-3">
            {{ new Date(comment.created_at).toLocaleDateString() }}
          </span>
        </div>
        <button @click="toggleLike" class="text-sm flex items-center gap-1 hover:text-violet-400">
          ❤️ <span>{{ comment.likes_count || 0 }}</span>
        </button>
      </div>

      <p class="mt-3 text-zinc-300 leading-relaxed">{{ comment.content }}</p>

      <button @click="showReplyForm = !showReplyForm"
        class="text-violet-400 text-sm mt-4 hover:underline">
        {{ showReplyForm ? 'Cancel Reply' : 'Reply' }}
      </button>
    </div>

    <!-- Reply Form -->
    <div v-if="showReplyForm" class="mt-4 ml-0 bg-zinc-900 rounded-3xl p-6 border border-zinc-700">
      <h4 class="font-semibold mb-4 text-sm">Reply to {{ comment.author_name }}</h4>
      <form @submit.prevent="submitReply" class="space-y-4">
        <div class="grid md:grid-cols-2 gap-4">
          <input v-model="replyForm.author_name" type="text" placeholder="Your Name" required
            class="bg-zinc-800 border border-zinc-700 rounded-2xl px-5 py-3 focus:border-violet-500 outline-none">
          <input v-model="replyForm.author_email" type="email" placeholder="Email (optional)"
            class="bg-zinc-800 border border-zinc-700 rounded-2xl px-5 py-3 focus:border-violet-500 outline-none">
        </div>
        <textarea v-model="replyForm.content" rows="3" placeholder="Write your reply..." required
          class="w-full bg-zinc-800 border border-zinc-700 rounded-3xl px-5 py-4 focus:border-violet-500 outline-none resize-none"></textarea>
        <div class="flex gap-3">
          <button type="submit" :disabled="submitting"
            class="bg-violet-600 hover:bg-violet-700 px-6 py-2 rounded-2xl font-medium transition disabled:opacity-50">
            {{ submitting ? 'Posting...' : 'Post Reply' }}
          </button>
          <button type="button" @click="showReplyForm = false"
            class="bg-zinc-800 hover:bg-zinc-700 px-6 py-2 rounded-2xl font-medium transition">
            Cancel
          </button>
        </div>
      </form>
    </div>

    <!-- Replies -->
    <div v-if="comment.replies?.length" class="mt-6 space-y-6">
      <CommentItem
        v-for="reply in comment.replies"
        :key="reply.id"
        :comment="reply"
        :post-id="postId"
        @reply="$emit('reply', $event)"
        @refresh="$emit('refresh')"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive } from 'vue'

const props = defineProps<{
  comment: any
  postId: number
}>()

const emit = defineEmits(['reply', 'refresh'])

const showReplyForm = ref(false)
const submitting = ref(false)

const replyForm = reactive({
  author_name: '',
  author_email: '',
  content: ''
})

const toggleLike = async () => {
  try {
    const response = await fetch(`http://localhost:8000/api/v1/comments/${props.comment.id}/like`, { method: 'POST' });
    if (!response.ok) throw new Error('Network response was not ok');
    const data = await response.json();
    props.comment.likes_count = data.likes_count;
  } catch (error) {
    console.error('Failed to like the comment:', error);
    alert('Failed to like the comment. Please try again.');
  }
}

const submitReply = async () => {
  submitting.value = true
  try {
    const response = await fetch(`http://localhost:8000/api/v1/comments/${props.comment.id}/reply`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(replyForm)
    })

    if (!response.ok) throw new Error('Failed to post reply')

    replyForm.author_name = ''
    replyForm.author_email = ''
    replyForm.content = ''
    showReplyForm.value = false

    // Emit refresh to reload comments
    emit('refresh')
  } catch (error) {
    console.error('Failed to post reply:', error)
    alert('Failed to post reply. Please try again.')
  }
  submitting.value = false
}
</script>
