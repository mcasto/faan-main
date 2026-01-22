<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <q-page>
        <q-header class="bg-white shadow-1 text-black">
          <q-toolbar>
            <q-toolbar-title>
              Admin Toolbar
            </q-toolbar-title>
            <div class="q-gutter-x-sm">
              <q-btn
                label="Add Event"
                :to="{ name: 'admin-add-event' }"
              ></q-btn>

              <q-btn icon="home" :to="{ name: 'home' }"></q-btn>
            </div>
          </q-toolbar>
        </q-header>

        <router-view />
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { Screen } from "quasar";
import { useStore } from "src/stores/store";
import NavDrawer from "src/components/NavDrawer.vue";

const store = useStore();
</script>
