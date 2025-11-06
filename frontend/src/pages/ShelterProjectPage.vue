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
      :rows="store.sanctuary.budget.items"
      hide-bottom
      :pagination="{ rowsPerPage: 0 }"
      class="q-mb-md"
      :columns="columns"
      dense
    >
      <template #body-cell-tools="props">
        <q-td class="text-right">
          <q-btn
            icon="info"
            flat
            round
            @click="
              rowInfo = {
                visible: true,
                title: props.row.name,
                theme: props.row.theme,
                description: props.row.description,
              }
            "
          ></q-btn>
        </q-td>
      </template>
    </q-table>
  </div>

  <budget-dialog
    v-model="rowInfo.visible"
    :title="rowInfo.title"
    :theme="rowInfo.theme"
    :description="rowInfo.description"
  ></budget-dialog>
</template>

<script setup>
import { Screen } from "quasar";
import { useStore } from "src/stores/store";
import { computed, ref } from "vue";
import BudgetDialog from "src/components/BudgetDialog.vue";

const store = useStore();

const rowInfo = ref({
  visible: false,
  title: null,
  theme: null,
  description: null,
});

console.log({ sanctuary: store.sanctuary });

const columns = [
  {
    label: "PHASE",
    name: "phase",
    field: "phase",
    align: "left",
  },
  {
    label: "NAME",
    name: "name",
    field: "name",
    align: "left",
  },
  {
    label: "BUILDING COST",
    name: "building_cost",
    field: "building_cost",
    align: "left",
  },
  {
    label: "",
    name: "tools",
    align: "right",
  },
];

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
/* Optional styling for better visual hierarchy */
.q-item {
  border-left: 3px solid transparent;
}
.q-item:hover {
  border-left: 3px solid #1976d2;
  background-color: rgba(25, 118, 210, 0.04);
}
</style>
