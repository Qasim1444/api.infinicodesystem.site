<template>
  <div class="pt-24 pb-20 px-6 max-w-6xl mx-auto">
    <div class="text-center mb-16">
      <h1 class="text-6xl font-bold tracking-tighter mb-4">Our Projects</h1>
      <p class="text-zinc-400 text-lg">Selected work that we're proud of</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
      <div v-for="project in projects" :key="project.id"
           class="group relative overflow-hidden rounded-3xl aspect-video bg-zinc-800 cursor-pointer">

        <!-- Project Image -->
        <img :src="project.image"
             :alt="project.title"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-90 group-hover:opacity-95 transition"></div>

        <!-- Content -->
        <div class="absolute bottom-8 left-8 right-8">
          <div class="flex flex-wrap gap-2 mb-3">
            <span v-for="tag in project.tags"
                  :key="tag"
                  class="text-xs px-3 py-1 bg-white/10 backdrop-blur-md rounded-full text-white">
              {{ tag }}
            </span>
          </div>

          <h3 class="text-3xl font-bold text-white mb-2">{{ project.title }}</h3>
          <p class="text-zinc-300 text-sm line-clamp-2 mb-4">{{ project.description }}</p>

          <div class="flex items-center justify-between">
            <p class="text-violet-400 text-sm font-medium">
              {{ project.tech }}
            </p>
            <button class="text-sm flex items-center gap-2 text-white hover:text-violet-400 transition">
              View Case Study
              <span class="text-lg leading-none">→</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
const projects = [
  {
    id: 1,
    title: "Lumina — Fashion E-commerce",
    description: "Modern, high-performance online store with seamless checkout and inventory management.",
    image: "https://images.unsplash.com/photo-1445205170230-053b83016050?w=800&h=450&fit=crop",
    tags: ["E-commerce", "Branding"],
    tech: "Nuxt 3 + Laravel + Stripe"
  },
  {
    id: 2,
    title: "Forge — SaaS Dashboard",
    description: "Powerful project management and team collaboration platform with real-time updates.",
    image: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=450&fit=crop",
    tags: ["SaaS", "Dashboard"],
    tech: "Nuxt 3 + Laravel + Inertia"
  },
  {
    id: 3,
    title: "Velora — Creative Agency",
    description: "Stunning portfolio website for a luxury creative agency with smooth animations.",
    image: "https://images.unsplash.com/photo-1547658719-da2b51169166?w=800&h=450&fit=crop",
    tags: ["Portfolio", "Design"],
    tech: "Nuxt 3 + Tailwind + Framer Motion"
  },
{
    id: 4,
    title: "UrbanNest — Real Estate Platform",
    description: "Luxury property marketplace with virtual tours, smart search, and agent dashboard.",
    image: "https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&h=450&fit=crop",   // ✅ New Image
    tags: ["Real Estate", "Marketplace"],
    tech: "Nuxt 3 + Laravel + Mapbox"
  },
  {
    id: 5,
    title: "EduSpark — Online Learning Platform",
    description: "Interactive learning management system with courses, quizzes, and progress tracking.",
    image: "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=450&fit=crop",
    tags: ["EdTech", "LMS"],
    tech: "Laravel + Nuxt 3 + MySQL"
  },
  {
    id: 6,
    title: "Nexlify — Fintech Dashboard",
    description: "Real-time financial analytics and investment tracking platform for modern investors.",
    image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=450&fit=crop",
    tags: ["Fintech", "Analytics"],
    tech: "Nuxt 3 + Laravel + Livewire"
  }
]
</script>
