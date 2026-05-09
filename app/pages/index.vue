<template>
  <div>
    <!-- Hero Section -->
    <section class="pt-32 pb-24 px-6 text-center">
      <div class="max-w-5xl mx-auto">
        <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold tracking-tighter leading-none mb-6">
          We craft digital<br>experiences that <span class="text-violet-400">matter</span>
        </h1>
        <p class="text-xl text-zinc-400 max-w-2xl mx-auto mb-10">
          A creative digital agency helping bold brands stand out in the modern digital world.
        </p>
        <div class="flex gap-4 justify-center flex-wrap">
          <NuxtLink to="/blog" class="bg-violet-600 hover:bg-violet-700 px-8 py-4 rounded-2xl text-lg font-medium transition">
            Read Our Journal
          </NuxtLink>
          <NuxtLink to="/contact" class="border border-zinc-700 hover:border-white px-8 py-4 rounded-2xl text-lg font-medium transition">
            Start a Project
          </NuxtLink>
        </div>
      </div>
    </section>

    <!-- Statistics -->
    <section class="py-20 px-6 bg-zinc-900">
      <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
        <div v-for="(stat, i) in stats" :key="i">
          <div class="text-5xl font-bold text-violet-400 mb-2">{{ stat.number }}</div>
          <div class="text-zinc-400">{{ stat.label }}</div>
        </div>
      </div>
    </section>

    <!-- Trusted By -->
    <section class="py-16 border-t border-b border-zinc-800 bg-zinc-950">
      <div class="max-w-6xl mx-auto px-6">
        <p class="text-center text-zinc-500 text-sm mb-8 tracking-widest">TRUSTED BY AMAZING BRANDS</p>
        <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-10 opacity-75 hover:opacity-100 transition-all duration-500">
          <div class="text-3xl font-bold tracking-tight">Nike</div>
          <div class="text-3xl font-bold tracking-tight">Apple</div>
          <div class="text-3xl font-bold tracking-tight">Stripe</div>
          <div class="text-3xl font-bold tracking-tight">Vercel</div>
          <div class="text-3xl font-bold tracking-tight">Notion</div>
          <div class="text-3xl font-bold tracking-tight">Webflow</div>
        </div>
      </div>
    </section>

    <!-- Our Process -->
    <section class="py-24 px-6 bg-zinc-900">
      <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold mb-4">Our Process</h2>
          <p class="text-zinc-400 text-lg max-w-2xl mx-auto">
            A simple, transparent 5-step process that delivers exceptional results
          </p>
        </div>

        <div class="grid md:grid-cols-5 gap-8">
          <div v-for="(step, i) in process" :key="i"
               class="relative bg-zinc-800 rounded-3xl p-8 text-center group hover:bg-zinc-700 transition-all">
            <div class="w-12 h-12 mx-auto mb-6 bg-violet-500/10 text-violet-400 rounded-2xl flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition">
              {{ i + 1 }}
            </div>
            <h3 class="text-xl font-semibold mb-3">{{ step.title }}</h3>
            <p class="text-zinc-400 text-sm leading-relaxed">{{ step.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Latest Stories -->
    <section class="py-24 px-6">
      <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-end mb-12">
          <h2 class="text-5xl font-bold">Latest Stories</h2>
          <NuxtLink to="/blog" class="text-violet-400 hover:underline text-lg">
            View All Posts →
          </NuxtLink>
        </div>

        <div v-if="pending" class="text-center py-12 text-zinc-400">Loading latest posts...</div>
        <div v-else-if="error" class="text-red-500 text-center py-12">Failed to load posts.</div>

        <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <PostCard v-for="post in latestPosts" :key="post.id" :post="post" />
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 px-6 bg-zinc-900">
      <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold mb-4">What Our Clients Say</h2>
          <p class="text-zinc-400 text-lg">Real stories from real businesses</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <div v-for="(testimonial, i) in testimonials" :key="i"
               class="bg-zinc-800 border border-zinc-700 rounded-3xl p-8 hover:border-violet-500 transition-all">
            <div class="text-4xl mb-6">⭐⭐⭐⭐⭐</div>
            <p class="text-zinc-300 italic leading-relaxed mb-8">"{{ testimonial.quote }}"</p>
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-zinc-700 rounded-full overflow-hidden flex-shrink-0">
                <img :src="testimonial.image"
                     :alt="testimonial.name"
                     class="w-full h-full object-cover">
              </div>
              <div>
                <p class="font-semibold">{{ testimonial.name }}</p>
                <p class="text-sm text-zinc-500">{{ testimonial.position }}, {{ testimonial.company }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-24 px-6 bg-zinc-900">
      <div class="max-w-6xl mx-auto">
        <h2 class="text-5xl font-bold text-center mb-16">Why Choose Us</h2>
        <div class="grid md:grid-cols-3 gap-8">
          <div v-for="(item, i) in whyUs" :key="i" class="bg-zinc-800 p-8 rounded-3xl">
            <div class="text-4xl mb-6">{{ item.icon }}</div>
            <h3 class="text-2xl font-semibold mb-3">{{ item.title }}</h3>
            <p class="text-zinc-400">{{ item.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Meet Our Team -->
    <section class="py-24 px-6">
      <div class="max-w-6xl mx-auto">
        <h2 class="text-5xl font-bold text-center mb-16">Meet Our Team</h2>
        <div class="grid md:grid-cols-4 gap-8">
          <div v-for="(member, i) in team" :key="i" class="text-center group">
            <div class="w-48 h-48 mx-auto bg-zinc-800 rounded-3xl mb-6 overflow-hidden shadow-xl group-hover:scale-105 transition-transform duration-300">
              <img :src="member.image"
                   :alt="member.name"
                   class="w-full h-full object-cover">
            </div>
            <h3 class="font-semibold text-xl">{{ member.name }}</h3>
            <p class="text-violet-400">{{ member.role }}</p>
            <p class="text-zinc-500 text-sm mt-1">{{ member.bio }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Newsletter -->
    <section class="py-20 px-6 bg-black">
      <div class="max-w-2xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4">Stay Updated</h2>
        <p class="text-zinc-400 mb-8">Get the latest insights, trends, and project updates.</p>
        <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
          <input v-model="email" type="email" placeholder="Enter your email"
            class="flex-1 bg-zinc-900 border border-zinc-700 rounded-2xl px-6 py-4 focus:border-violet-500 outline-none">
          <button @click="subscribe" :disabled="subscribing"
            class="bg-violet-600 hover:bg-violet-700 px-10 py-4 rounded-2xl font-medium disabled:opacity-50">
            {{ subscribing ? 'Subscribing...' : 'Subscribe' }}
          </button>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="py-24 px-6">
      <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold mb-4">Frequently Asked Questions</h2>
          <p class="text-zinc-400">Everything you want to know</p>
        </div>

        <div class="space-y-4">
          <div v-for="(faq, i) in faqs" :key="i" class="bg-zinc-800 rounded-3xl overflow-hidden">
            <button @click="toggleFaq(i)"
              class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-zinc-700 transition">
              <span class="text-lg font-medium">{{ faq.question }}</span>
              <span class="text-2xl transition" :class="{ 'rotate-180': openFaq === i }">↓</span>
            </button>
            <div v-if="openFaq === i" class="px-8 pb-8 text-zinc-400 leading-relaxed">
              {{ faq.answer }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
const { data: latestPosts, pending, error } = await useAsyncData('latest-posts', () =>
  $fetch('http://localhost:8000/api/v1/posts')
)

// Static Data
const testimonials = [
  {
    quote: "Working with this team transformed our online presence. Our conversion rate increased by 180% in just three months.",
    name: "Sarah Chen",
    position: "CEO & Founder",
    company: "Lumina Studio",
    image: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop"
  },
  {
    quote: "The best digital agency we've ever worked with. They truly understand brand and user experience.",
    name: "Marcus Rodriguez",
    position: "Head of Marketing",
    company: "Forge Dynamics",
    image: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop"
  },
  {
    quote: "They delivered beyond our expectations. Our new website is not just beautiful — it's a powerful business tool.",
    name: "Aisha Patel",
    position: "Creative Director",
    company: "Velora",
    image: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop"
  }
]

const team = [
  {
    name: "Alex Rivera",
    role: "Founder & Creative Director",
    bio: "10+ years crafting digital experiences",
    image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=600&fit=crop"
  },
  {
    name: "Priya Sharma",
    role: "Head of Design",
    bio: "UI/UX perfectionist & branding expert",
    image: "data:image/jpeg;base64,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"
  },
  {
    name: "Jamal Thompson",
    role: "Lead Developer",
    bio: "Nuxt & Laravel wizard",
    image: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=600&h=600&fit=crop"
  },
  {
    name: "Elena Voss",
    role: "Strategy & Growth",
    bio: "Turning ideas into measurable success",
    image: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&h=600&fit=crop"
  }
]

const email = ref('')
const subscribing = ref(false)

const subscribe = async () => {
  if (!email.value) return
  subscribing.value = true
  try {
    await $fetch('http://localhost:8000/api/v1/subscribe', {
      method: 'POST',
      body: { email: email.value }
    })
    alert('Successfully subscribed to our newsletter!')
    email.value = ''
  } catch (e: any) {
    alert(e.data?.errors?.email?.[0] || 'Failed to subscribe. Please try again.')
  }
  subscribing.value = false
}

const whyUs = [
  { icon: "⚡", title: "Lightning Fast", desc: "Optimized performance & quick delivery" },
  { icon: "🎯", title: "Result Driven", desc: "Focused on your business goals" },
  { icon: "🛠️", title: "Full Support", desc: "Maintenance & updates included" }
]

const stats = [
  { number: "50+", label: "Projects Delivered" },
  { number: "28", label: "Happy Clients" },
  { number: "4.9", label: "Average Rating" },
  { number: "98%", label: "Client Retention" }
]

const process = [
  { title: "Discovery", desc: "Understanding your goals, audience, and brand vision." },
  { title: "Strategy", desc: "Creating a clear roadmap and project strategy." },
  { title: "Design", desc: "Crafting beautiful, user-friendly interfaces." },
  { title: "Development", desc: "Building fast, secure, and scalable solutions." },
  { title: "Launch & Grow", desc: "Going live and supporting continuous growth." }
]

const faqs = [
  {
    question: "How long does a typical project take?",
    answer: "Most websites take 4-8 weeks depending on complexity. We provide a clear timeline during the proposal stage."
  },
  {
    question: "Do you provide ongoing maintenance and support?",
    answer: "Yes! We offer monthly maintenance packages and dedicated support for all our clients."
  },
  {
    question: "What technologies do you work with?",
    answer: "We specialize in Nuxt.js, Laravel, Tailwind CSS, and modern full-stack solutions."
  },
  {
    question: "Can you redesign our existing website?",
    answer: "Absolutely. We love taking old websites and turning them into modern, high-performing digital experiences."
  }
]

const openFaq = ref<number | null>(null)

const toggleFaq = (index: number) => {
  openFaq.value = openFaq.value === index ? null : index
}
</script>
