<template>
  <div class="q-py-md q-px-lg">
    <div class="row">
      <div class="col-8">
        <div :class="Screen.gt.sm ? 'text-h4' : 'text-h6'">
          {{ store.sanctuary.header }}
        </div>
        <div
          class="q-mb-lg"
          :class="Screen.gt.sm ? 'text-h6' : 'text-subtitle1'"
        >
          {{ store.sanctuary.subtitle }}
        </div>
        <div v-html="store.sanctuary.overview"></div>
        <video :width="vid.width" :height="vid.height" controls>
          <source :src="store.sanctuary.video" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="col text-right">
        <q-img
          :src="superdogsSrc"
          class="q-mb-md"
          alt="SuperDogs Logo"
          width="20vw"
        />
      </div>
    </div>

    <div v-html="store.sanctuary.community"></div>

    <q-separator spaced></q-separator>

    <div v-html="store.sanctuary.budget.header"></div>

    <q-table
      class="budget-table"
      :rows="store.sanctuary.budget.items"
      hide-header
      separator="cell"
    >
      <template #body="{ row: item }">
        <q-tr>
          <q-td class="col-1">
            <div class="cell-content text-caption">
              {{ item.phase.label }}: {{ item.phase.value }}
            </div>
            <div class="cell-content text-h6">
              {{ item.name.value }}
            </div>
            <div class="cell-content text-subtitle1">
              {{ item.building_cost.value }}
            </div>
          </q-td>

          <q-td class="col-2">
            <div class="cell-content text-h6">
              {{ item.theme.label }}
            </div>
            <div class="cell-content">
              {{ item.theme.value }}
            </div>
          </q-td>

          <q-td class="col-3">
            <div class="cell-content text-h6">
              {{ item.description.label }}
            </div>
            <div class="cell-content">
              {{ item.description.value }}
            </div>
          </q-td>
        </q-tr>
      </template>
      <template #bottom>
        <div class="flex justify-end text-right full-width">
          <div v-html="store.sanctuary.total"></div>
        </div>
      </template>
    </q-table>
  </div>
</template>

<script setup>
import { Screen } from "quasar";
import { useStore } from "src/stores/store";
import { computed, ref } from "vue";

const store = useStore();

const rowInfo = ref({
  visible: false,
  title: null,
  theme: null,
  description: null,
});

const vid = computed(() => {
  const originalWidth = 854;
  const originalHeight = 480;

  let width = Screen.gt.sm ? Screen.width * 0.5 : Screen.width * 0.9;
  if (width > 854) {
    width = 854;
  }

  const height = Math.round((originalHeight / originalWidth) * width);

  return {
    width,
    height,
  };
});

const superdogsSrc = computed(() => {
  return `/images/superdogs-logo-${store.language}.png`;
});
</script>

<style scoped>
/* 🔒 Step 1: force real table layout behavior */
.budget-table .q-table__middle table {
  table-layout: fixed !important;
  width: 100% !important;
}

/* 🔒 Step 2: hard-assign widths */
.budget-table .q-table__middle td.col-1 {
  width: 20% !important;
}
.budget-table .q-table__middle td.col-2 {
  width: 40% !important;
}
.budget-table .q-table__middle td.col-3 {
  width: 40% !important;
}

/* 🔒 Step 3: prevent content from blowing out the cell */
.budget-table .cell-content {
  display: block;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  min-width: 0;
}

.budget-table .cell-content {
  white-space: normal;
  word-wrap: break-word;
  overflow-wrap: break-word;
}
</style>
