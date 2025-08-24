<template>
  <div class="row">
    <div class="col-12 col-md-6 info q-pa-md text-subtitle1">
      <div class="text-h4">
        {{ store.sanctuary.header }}
      </div>
      <div class="text-h6 q-mb-lg">
        {{ store.sanctuary.subtitle }}
      </div>

      <div v-html="store.sanctuary.overview"></div>

      <div class="text-h6 q-mt-md">
        {{ store.sanctuary.project_header }}
      </div>

      <div
        v-for="phase in store.sanctuary.phases"
        :key="phase.title"
        class="q-mb-lg q-ml-md"
      >
        <!-- Phase Header -->
        <div class="text-h6 q-pb-sm text-primary">{{ phase.title }}</div>

        <!-- Phase Items -->
        <q-list bordered separator>
          <template v-for="item in phase.items" :key="item.title">
            <!-- Main Item -->
            <q-item>
              <q-item-section avatar>
                <q-icon
                  :name="
                    item.completed ? 'check_circle' : 'radio_button_unchecked'
                  "
                  :color="item.completed ? 'positive' : 'grey'"
                />
              </q-item-section>
              <q-item-section>
                <q-item-label>{{ item.title }}</q-item-label>
              </q-item-section>
            </q-item>

            <!-- Child Items (always shown) -->
            <template v-if="item.children">
              <q-item
                v-for="child in item.children"
                :key="child.title"
                class="q-pl-xl"
              >
                <q-item-section avatar>
                  <q-icon
                    :name="
                      child.completed
                        ? 'check_circle'
                        : 'radio_button_unchecked'
                    "
                    :color="child.completed ? 'positive' : 'grey'"
                    size="sm"
                  />
                </q-item-section>
                <q-item-section>
                  <q-item-label class="text-caption">{{
                    child.title
                  }}</q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </template>
        </q-list>
      </div>

      <div v-html="store.sanctuary.community"></div>
    </div>
    <div class="location col-12 col-md-6 q-pa-md">
      <div v-html="store.sanctuary.preview"></div>
    </div>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();
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
