<template>
  <div>
    <embed :src="pdfUrl" type="application/pdf" width="100%" style='height:100vh' />

    <p v-if="!isPdfAvailable" class="text-negative">

      <div>
        PDF not available for the current language.
      </div>

      <!-- Alternative: Download link -->
      <a :href="pdfUrl" download class="q-mt-md">
        Download PDF
      </a>
    </p>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";
import { computed } from "vue";

const store = useStore();

const pdfUrl = computed(() => {
  const lang = store.language || "en";
  return `/downloadable/five-year-plan-${lang}.pdf`;
});

// Optional: Check if PDF exists (you might need to implement this differently)
const isPdfAvailable = computed(() => {
  return store.language === "en" || store.language === "es";
});
</script>
