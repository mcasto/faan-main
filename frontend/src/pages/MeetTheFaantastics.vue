<template>
  <div class="q-pa-md">
    <div class="text-center text-h5 q-mb-xl">
      {{ store.meetFaantastics.header }}
    </div>
    <div class="column q-gutter-y-lg">
      <q-card class="q-pa-md">
        <q-card-section>
          <div class="text-h6">{{ store.meetFaantastics.board.header }}</div>
          <div v-html="store.meetFaantastics.board.text"></div>
        </q-card-section>
      </q-card>

      <q-card class="q-pa-md">
        <q-card-section>
          <div class="text-h6">
            {{ store.meetFaantastics.sanctuary.header }}
          </div>
          <div v-html="store.meetFaantastics.sanctuary.text"></div>
        </q-card-section>
      </q-card>

      <q-card class="q-pa-md">
        <q-card-section>
          <div class="text-h6">{{ store.meetFaantastics.gala.header }}</div>
          <div v-html="store.meetFaantastics.gala.text"></div>
        </q-card-section>
      </q-card>
    </div>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();
</script>
