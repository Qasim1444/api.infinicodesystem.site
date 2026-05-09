<!-- app.vue -->
<template>
  <div class="min-h-screen bg-zinc-950 text-white font-sans">
    <Navbar />
    <NuxtPage />
    <Footer />
  </div>
</template>

<script setup>
useHead({
  script: [{ src: 'https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4', defer: true }],
  title: 'Agency — Creative Digital Studio',
  meta: [{ name: 'description', content: 'Modern Digital Agency & Blog' }]
})
</script>