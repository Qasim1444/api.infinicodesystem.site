<template>
  <div class="mt-16 border-t border-zinc-800 pt-12">
    <h2 class="text-3xl font-bold mb-8">Comments ({{ comments.length }})</h2>

    <!-- New Comment Form -->
    <div class="bg-zinc-900 rounded-3xl p-6 mb-10">
      <h3 class="font-semibold mb-4">Leave a comment</h3>
      <form @submit.prevent="submitComment" class="space-y-4">
        <div class="grid md:grid-cols-2 gap-4">
          <input v-model="newComment.author_name" type="text" placeholder="Your Name" required
            class="bg-zinc-800 border border-zinc-700 rounded-2xl px-5 py-3 focus:border-violet-500 outline-none">
          <input v-model="newComment.author_email" type="email" placeholder="Email (optional)"
            class="bg-zinc-800 border border-zinc-700 rounded-2xl px-5 py-3 focus:border-violet-500 outline-none">
        </div>
        <textarea v-model="newComment.content" rows="4" placeholder="Write your comment..." required
          class="w-full bg-zinc-800 border border-zinc-700 rounded-3xl px-5 py-4 focus:border-violet-500 outline-none resize-none"></textarea>
        <button type="submit" :disabled="submitting"
          class="bg-violet-600 hover:bg-violet-700 px-8 py-3 rounded-2xl font-medium transition disabled:opacity-50">
          {{ submitting ? 'Posting...' : 'Post Comment' }}
        </button>
      </form>
    </div>

    <!-- Comments List -->
    <div v-if="comments.length" class="space-y-8">
      <CommentItem
        v-for="comment in comments"
        :key="comment.id"
        :comment="comment"
        :post-id="postId"
        @refresh="loadComments"
      />
    </div>
    <div v-else class="text-zinc-400 py-8 text-center">
      No comments yet. Be the first to comment!
    </div>
  </div>
</template>

<script setup lang="ts">
import CommentItem from './CommentItem.vue'

const props = defineProps<{
  postId: number
}>()

const newComment = reactive({
  post_id: props.postId,
  author_name: '',
  author_email: '',
  content: '',
  parent_id: null as number | null
})

const comments = ref<any[]>([])
const submitting = ref(false)

const loadComments = async () => {
  try {
    const data = await $fetch(`http://localhost:8000/api/v1/comments?post_id=${props.postId}`)
    comments.value = Array.isArray(data) ? data : [data] // Ensure comments is always an array
  } catch (e) {
    console.error(e)
  }
}

const submitComment = async () => {
  submitting.value = true
  try {
    await $fetch('http://localhost:8000/api/v1/comments', {
      method: 'POST',
      body: newComment
    })
    newComment.content = ''
    newComment.parent_id = null
    await loadComments()
  } catch (e) {
    alert('Failed to post comment')
  }
  submitting.value = false
}

onMounted(loadComments)
</script>
