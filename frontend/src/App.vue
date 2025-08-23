<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script setup>
import { useStore } from "./stores/store";
import { useRouter } from "vue-router";
import { watch } from "vue";

const store = useStore();
const router = useRouter();

// Function to get the full canonical URL
function getCanonicalUrl(path = null) {
  // Use the current path if none provided
  const currentPath = path || router.currentRoute.value.fullPath;

  // Get the current domain from the browser
  const domain = window.location.origin;

  // Remove any trailing slashes and combine with path
  const cleanDomain = domain.endsWith("/") ? domain.slice(0, -1) : domain;
  const cleanPath = currentPath.startsWith("/")
    ? currentPath
    : `/${currentPath}`;

  return `${cleanDomain}${cleanPath}`;
}

// Function to update all meta tags in the DOM
function updateAllMetaTags(flatMeta) {
  if (!flatMeta || typeof flatMeta !== "object") return;

  // Update title
  if (flatMeta.title) {
    document.title = flatMeta.title;
  }

  // Update standard meta tags
  updateMetaTag("name", "description", flatMeta.description);
  updateMetaTag("name", "keywords", flatMeta.keywords);

  // Update Open Graph meta tags
  updateMetaTag("property", "og:title", flatMeta.ogTitle || flatMeta.title);
  updateMetaTag(
    "property",
    "og:description",
    flatMeta.ogDescription || flatMeta.description
  );
  updateMetaTag("property", "og:locale", flatMeta.ogLocale);
  updateMetaTag("property", "og:image", flatMeta.ogImage);

  // Use dynamic URL for og:url and canonical
  const currentUrl = getCanonicalUrl();
  updateMetaTag("property", "og:url", currentUrl);
  updateLinkTag("canonical", currentUrl);
}

// Helper function to update or create meta tags
function updateMetaTag(attrName, attrValue, content) {
  if (!content) return;

  let tag = document.querySelector(`meta[${attrName}="${attrValue}"]`);

  if (tag) {
    tag.setAttribute("content", content);
  } else {
    tag = document.createElement("meta");
    tag.setAttribute(attrName, attrValue);
    tag.setAttribute("content", content);
    document.head.appendChild(tag);
  }
}

// Helper function to update or create link tags
function updateLinkTag(rel, href) {
  if (!href) return;

  let tag = document.querySelector(`link[rel="${rel}"]`);

  if (tag) {
    tag.setAttribute("href", href);
  } else {
    tag = document.createElement("link");
    tag.setAttribute("rel", rel);
    tag.setAttribute("href", href);
    document.head.appendChild(tag);
  }
}

// Watch for changes in store.meta
watch(
  () => store.meta,
  (newMeta) => {
    if (newMeta && typeof newMeta === "object") {
      updateAllMetaTags(newMeta);
    }
  },
  { immediate: true, deep: true }
);

// Update meta tags on route changes
router.afterEach(() => {
  // Small delay to allow store to update after route change
  setTimeout(() => {
    if (store.meta) {
      updateAllMetaTags(store.meta);
    }
  }, 50);
});
</script>
