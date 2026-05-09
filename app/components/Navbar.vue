<template>
  <nav class="fixed top-0 w-full bg-zinc-950/90 backdrop-blur-md z-50 border-b border-zinc-800">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
      <NuxtLink to="/" class="text-2xl font-bold tracking-tight">
infinicodesystem<span class="text-violet-500">.</span>
      </NuxtLink>

     <div class="hidden md:flex items-center space-x-8 text-sm uppercase tracking-widest">
  <NuxtLink to="/" class="hover:text-violet-400 transition">Home</NuxtLink>
  <NuxtLink to="/projects" class="hover:text-violet-400 transition">Projects</NuxtLink>
  <NuxtLink to="/services" class="hover:text-violet-400 transition">Services</NuxtLink>
  <NuxtLink to="/blog" class="hover:text-violet-400 transition">Journal</NuxtLink>
  <NuxtLink to="/about" class="hover:text-violet-400 transition">About</NuxtLink>
  <NuxtLink to="/contact" class="hover:text-violet-400 transition">Contact</NuxtLink>
</div>

      <button @click="contactClick"
        class="bg-white text-black px-6 py-3 rounded-full text-sm font-medium hover:bg-violet-500 hover:text-white transition">
        Let's Talk
      </button>
    </div>
  </nav>
</template>

<script setup>
const contactClick = () => {
  navigateTo('/contact')
}
</script>
