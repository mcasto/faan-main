<template>
  <q-toolbar class="q-py-md q-px-md">
    <router-link :to="{ name: 'home' }">
      <q-img
        src="/images/faan-logo.png"
        height="48px"
        fit="contain"
        width="64px"
        style="z-index: 999999;"
      ></q-img>
    </router-link>
  </q-toolbar>

  <q-separator color="black"></q-separator>
  <div class="flex items-center flex-center q-pa-sm bg-blue-1">
    Language: &nbsp;
    <a
      href="#"
      style="text-decoration: none;"
      @click="store.language = 'en'"
      class="text-blue-10"
      :class="{ 'text-bold': store.language == 'en' }"
      >English</a
    >
    <q-separator vertical spaced color="black"></q-separator
    ><a
      href="#"
      style="text-decoration: none;"
      @click="store.language = 'es'"
      class="text-blue-10"
      :class="{ 'text-bold': store.language == 'es' }"
      >Spanish</a
    >
  </div>
  <q-separator color="black"></q-separator>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();
</script>
