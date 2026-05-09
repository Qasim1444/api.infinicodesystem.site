<template>
  <div class="pt-24 pb-16 px-6 max-w-4xl mx-auto">
    <div v-if="pending" class="text-center py-20">
      <p class="text-zinc-400">Loading post...</p>
    </div>

    <div v-else-if="error" class="text-center py-20 text-red-500">
      <p>Error loading post: {{ error.message }}</p>
      <button @click="refresh" class="mt-4 px-6 py-3 bg-violet-600 rounded-xl">
        Try Again
      </button>
    </div>

    <article v-else-if="post" class="prose prose-invert max-w-none">
      <!-- Image -->
      <img 
        v-if="post.image"
        :src="`http://localhost:8000/storage/${post.image}`" 
        class="w-full h-96 object-cover rounded-3xl mb-10"
        alt="Featured image"
      >

      <!-- Title -->
      <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
        {{ post.title }}
      </h1>

      <!-- Meta -->
      <div class="flex items-center gap-4 text-sm text-zinc-400 mb-10">
        <span v-if="post.category" class="bg-zinc-800 px-4 py-2 rounded-full">
          {{ post.category.name }}
        </span>
        <span>{{ new Date(post.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) }}</span>
      </div>

      <!-- Content -->
      <div class="prose prose-zinc prose-invert text-lg leading-relaxed" v-html="post.content"></div>

      <!-- Tags -->
      <div v-if="post.tags?.length" class="mt-12 flex flex-wrap gap-2">
        <span v-for="tag in post.tags" :key="tag.id"
          class="text-xs bg-zinc-800 text-zinc-300 px-4 py-2 rounded-full">
          #{{ tag.name }}
        </span>
      </div>

      <!-- Comments Section -->
    <CommentSection :post-id="post.id" />
    </article>

    <div v-else class="text-center py-20 text-zinc-400">
      Post not found.
    </div>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()

const { data: post, pending, error, refresh } = await useAsyncData(`post-${route.params.slug}`, () =>
  $fetch(`http://localhost:8000/api/v1/posts/${route.params.slug}`)
)
</script>