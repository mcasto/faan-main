<template>
  <div class="flex flex-center" style="height: 100vh;">
    <q-img src="images/home-splash.jpg" height="100vh" width="100vw">
      <!-- Matching Grant Banner -->
      <div class="absolute-top q-pa-md" style="z-index: 1;">
        <q-card
          class="matching-grant-banner q-pa-md text-center"
          style="
            background: linear-gradient(135deg, #26a69a 0%, #21ba45 100%);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
          "
        >
          <q-card-section class="q-pa-sm">
            <div class="row items-center justify-center q-gutter-x-sm">
              <q-icon
                name="volunteer_activism"
                size="sm"
                color="warning"
                class="gt-xs"
              />
              <div class="banner-text">
                <div
                  :class="$q.screen.gt.sm ? 'text-h5' : 'text-h6'"
                  class="text-weight-bold text-white q-mb-xs"
                >
                  <q-icon name="stars" size="xs" color="warning" />
                  {{ store.home.banner.header }}
                  <q-icon name="stars" size="xs" color="warning" />
                </div>
                <div
                  :class="$q.screen.gt.sm ? 'text-h6' : 'text-subtitle1'"
                  class="text-white"
                  style="line-height: 1.4;"
                >
                  {{ store.home.banner.text }}
                </div>
              </div>
              <q-icon
                name="volunteer_activism"
                size="sm"
                color="warning"
                class="gt-xs"
              />
            </div>
          </q-card-section>
        </q-card>
      </div>

      <div class="absolute-bottom" v-html="store.home.footer"></div>
    </q-img>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();
console.log(store.home);
</script>
