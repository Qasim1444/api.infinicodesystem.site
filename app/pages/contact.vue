<template>
  <div class="pt-24 pb-20 px-6 max-w-2xl mx-auto">
    <div class="text-center mb-12">
      <h1 class="text-6xl font-bold tracking-tighter mb-4">Let's Work Together</h1>
      <p class="text-zinc-400 text-lg">Tell us about your project and we'll get back to you soon.</p>
    </div>

    <form @submit.prevent="submitForm" class="space-y-8">
      <div class="grid md:grid-cols-2 gap-6">
        <input v-model="form.name" type="text" placeholder="Your Name" required
          class="bg-zinc-900 border border-zinc-700 rounded-2xl px-6 py-4 focus:outline-none focus:border-violet-500">
        <input v-model="form.email" type="email" placeholder="Email Address" required
          class="bg-zinc-900 border border-zinc-700 rounded-2xl px-6 py-4 focus:outline-none focus:border-violet-500">
      </div>

      <input v-model="form.subject" type="text" placeholder="Project Subject" required
        class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-6 py-4 focus:outline-none focus:border-violet-500">

      <textarea v-model="form.message" rows="8" placeholder="Tell us about your project..." required
        class="w-full bg-zinc-900 border border-zinc-700 rounded-3xl px-6 py-5 focus:outline-none focus:border-violet-500 resize-none"></textarea>

      <button type="submit"
        class="w-full bg-violet-600 hover:bg-violet-700 py-5 rounded-2xl text-lg font-medium transition">
        Send Message
      </button>
    </form>

    <div class="mt-16 text-center text-zinc-400">
      <p>Or email us directly at <span class="text-violet-400">info@infinicodesystem.site</span></p>
    </div>
  </div>
</template>

<script setup>
const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: ''
})

const submitForm = () => {
  alert('Thank you! We will contact you soon. (Demo)')
  // You can connect this to your Laravel API later
  form.name = ''
  form.email = ''
  form.subject = ''
  form.message = ''
}
</script>
