<template>
  <div class="pt-24 px-6 max-w-6xl mx-auto">
    <h1 class="text-5xl font-bold mb-12 text-center">Journal</h1>

    <div v-if="pending" class="text-center py-20">Loading blog posts...</div>
    
    <div v-else-if="error" class="text-red-500 text-center py-20">
      Error loading posts
    </div>

    <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <PostCard 
        v-for="post in posts" 
        :key="post.id" 
        :post="post" 
      />
    </div>
  </div>
</template>

<script setup lang="ts">
const { data: posts, pending, error } = await useAsyncData('all-posts', () =>
  $fetch('http://localhost:8000/api/v1/posts')
)
</script>