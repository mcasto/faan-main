<template>
  <q-dialog v-model="model">
    <q-card>
      <q-card-section>
        <div v-html="html"></div>
      </q-card-section>
      <q-card-actions class="justify-end">
        <q-btn
          color="red-4 text-black"
          :label="store.donations.formButtons.cancel"
          @click="$emit('cancel')"
        ></q-btn>
        <q-btn
          color="green-4 text-black"
          :label="store.donations.formButtons.continue"
          @click="$emit('confirm')"
        ></q-btn>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();

const model = defineModel();
const props = defineProps(["html"]);
const emits = defineEmits(["cancel", "confirm"]);
</script>
