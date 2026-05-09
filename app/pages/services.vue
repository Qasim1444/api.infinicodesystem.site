<template>
  <div class="pt-24 pb-20 px-6 max-w-6xl mx-auto">
    <div class="text-center mb-16">
      <h1 class="text-6xl font-bold tracking-tighter mb-4">Our Services</h1>
      <p class="text-xl text-zinc-400 max-w-2xl mx-auto">
        We help brands grow through thoughtful design, powerful development, and strategic digital marketing.
      </p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
      <div v-for="(service, i) in services" :key="i" 
           class="bg-zinc-900 border border-zinc-800 hover:border-violet-500 transition-all rounded-3xl p-10 group">
        <div class="text-5xl mb-6">{{ service.icon }}</div>
        <h3 class="text-3xl font-semibold mb-4">{{ service.title }}</h3>
        <p class="text-zinc-400 leading-relaxed">{{ service.desc }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
const services = [
  {
    icon: "🎨",
    title: "Brand Identity",
    desc: "Logo design, visual identity systems, brand guidelines, and complete brand storytelling."
  },
  {
    icon: "💻",
    title: "Web Development",
    desc: "Fast, modern, and scalable websites built with Nuxt, Laravel, and cutting-edge technologies."
  },
  {
    icon: "📱",
    title: "UI/UX Design",
    desc: "User-centered interface and experience design that converts visitors into customers."
  },
  {
    icon: "📈",
    title: "Digital Marketing",
    desc: "SEO, content strategy, social media management, and performance marketing campaigns."
  },
  {
    icon: "🚀",
    title: "E-commerce",
    desc: "High-converting online stores with excellent user experience and secure payment systems."
  },
  {
    icon: "🤖",
    title: "Custom Solutions",
    desc: "Bespoke web applications, dashboards, and automation tools tailored to your business."
  }
]
</script>