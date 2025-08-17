<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <q-page>
        <q-header class="bg-white shadow-1">
          <q-toolbar class="justify-between" v-if="Screen.lt.md">
            <q-btn
              icon="menu"
              color="grey-8"
              flat
              round
              @click="store.drawer = !store.drawer"
            ></q-btn>
            <q-img
              src="/images/faan-logo.png"
              height="32px"
              fit="contain"
              width="43px"
              style="z-index: 999999;"
            ></q-img>
            <div></div>
          </q-toolbar>
        </q-header>

        <nav-drawer></nav-drawer>

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
