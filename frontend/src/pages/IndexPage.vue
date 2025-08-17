<template>
  <div class="flex flex-center" style="height: 100vh;">
    {{ store.language == "en" ? "Index Page" : "Página de índice" }}
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();
</script>
