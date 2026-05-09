<template>
  <NuxtLink :to="`/blog/${post.slug}`" class="group block">
    <div class="overflow-hidden rounded-3xl aspect-video bg-zinc-800 relative">
      <img 
        v-if="post.image"
        :src="`http://localhost:8000/storage/${post.image}`" 
        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
        alt=""
      >
      <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
      
      <div class="absolute bottom-6 left-6 right-6">
        <span 
          v-if="post.category?.name"
          class="inline-block text-xs uppercase tracking-widest bg-violet-500/20 text-violet-400 px-3 py-1 rounded-full mb-3"
        >
          {{ post.category.name }}
        </span>
        
        <h3 class="text-xl font-semibold leading-tight mb-2 line-clamp-2">
          {{ post.title }}
        </h3>
        
        <p class="text-sm text-zinc-400 line-clamp-2">
          {{ getExcerpt(post) }}
        </p>
      </div>
    </div>
  </NuxtLink>
</template>

<script setup lang="ts">
defineProps<{ post: any }>()

const getExcerpt = (post: any) => {
  if (!post.content) return ''
  const text = post.content.replace(/<[^>]+>/g, '') // remove HTML tags
  return text.length > 120 ? text.substring(0, 120) + '...' : text
}
</script>