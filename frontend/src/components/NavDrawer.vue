<template>
  <q-drawer v-model="store.drawer" show-if-above :width="256" bordered>
    <nav-header></nav-header>
    <q-list>
      <template v-for="item in navList" :key="item.name">
        <q-item
          v-if="!item.meta?.isChild"
          clickable
          :active="isItemActive(item)"
          active-class="text-bold"
          @click="handleClick(item)"
        >
          <q-item-section>
            <q-item-label>
              {{ item.meta.label[store.language] }}
            </q-item-label>
          </q-item-section>
          <q-item-section
            avatar
            v-if="item.name == 'faan-events' && flagEvents"
          >
            <q-icon name="mdi-circle-small" color="primary" size="md"></q-icon>
          </q-item-section>
          <q-item-section avatar v-if="item.children.length > 0">
            <q-icon
              :name="isExpanded(item.name) ? 'expand_less' : 'chevron_right'"
            />
          </q-item-section>

          <q-item-section avatar v-if="item.meta?.external">
            <q-icon name="open_in_new" size="xs" />
          </q-item-section>
        </q-item>

        <!-- Child items -->
        <q-list
          v-if="item.children.length > 0 && isExpanded(item.name)"
          dense
          class="q-pl-lg"
        >
          <q-item
            v-for="child in item.children"
            :key="child.name"
            clickable
            :to="{ name: child.name }"
            :active="$route.name === child.name"
            active-class="text-bold"
          >
            <q-item-section>
              <q-item-label>
                {{ child.meta.label[store.language] }}
              </q-item-label>
            </q-item-section>
            <q-item-section
              side
              v-if="child.name == 'upcoming-events' && flagEvents"
            >
              <q-badge
                color="primary"
                :label="`${store.events.upcoming.length} `"
              />
            </q-item-section>
          </q-item>
        </q-list>
      </template>
    </q-list>
  </q-drawer>
</template>

<script setup>
import { useStore } from "src/stores/store";
import NavHeader from "./NavHeader.vue";
import { computed, onMounted, ref, watch } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const store = useStore();

const navList = computed(() => {
  const list = store.router
    .getRoutes()
    .filter(({ name }) => name)
    .filter(({ meta }) => meta?.visible !== false);
  return list;
});

const expandedItems = ref([]);

// Check if item is expanded
const isExpanded = (itemName) => expandedItems.value.includes(itemName);

// Check if item or any of its children is active
const isItemActive = (item) => {
  if (item.name === route.name) return true;
  return item.children.some((child) => child.name === route.name);
};

// Toggle expansion
const toggleExpand = (itemName) => {
  const index = expandedItems.value.indexOf(itemName);
  if (index > -1) {
    expandedItems.value.splice(index, 1);
  } else {
    expandedItems.value.push(itemName);
  }
};

// Automatically expand parent when child is active
const expandActiveParents = () => {
  navList.value.forEach((item) => {
    if (item.children.some((child) => child.name === route.name)) {
      if (!isExpanded(item.name)) {
        expandedItems.value.push(item.name);
      }
    }
  });
};

const handleClick = (item) => {
  if (item.meta?.external) {
    window.open(item.meta.external, "_blank");
    return;
  }

  if (item.children.length > 0) {
    toggleExpand(item.name);
  } else {
    store.router.push({ name: item.name });
  }
};

const flagEvents = computed(() => {
  return store.events.upcoming.length > 0;
});

// Initialize on mount
onMounted(() => {
  expandActiveParents();
});

// Watch for route changes
watch(
  () => route.name,
  () => {
    expandActiveParents();
  }
);
</script>
