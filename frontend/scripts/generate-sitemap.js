// scripts/generate-sitemap.js
import { readFileSync, writeFileSync } from "fs";
import { resolve } from "path";
import { createRequire } from "module";
const require = createRequire(import.meta.url);

// 1. Read and parse routes file
const routesPath = resolve("./src/router/routes.js");
const routesFile = readFileSync(routesPath, "utf8");

// 2. Extract routes array using regex
const routesMatch = routesFile.match(/const routes = (\[[\s\S]*?\];)/);
if (!routesMatch) throw new Error("Routes array not found");

// 3. Safely evaluate routes in VM context
const { runInNewContext } = require("vm");
const sandbox = { exports: {} };
runInNewContext(
  `
  const routes = ${routesMatch[1]}
  exports.routes = routes;
`,
  sandbox
);

// 4. Extract all valid paths
function extractPaths(routesList, basePath = "") {
  const paths = [];
  for (const route of routesList) {
    // Skip external and dynamic routes
    if (route.meta?.external || route.path.includes(":")) continue;

    const fullPath = (basePath + route.path).replace(/\/+/g, "/");

    if (route.children) {
      paths.push(...extractPaths(route.children, fullPath));
    } else if (fullPath) {
      paths.push(fullPath);
    }
  }
  return [...new Set(paths)]; // Deduplicate
}

// 5. Generate XML
const paths = extractPaths(sandbox.exports.routes);
const hostname = "https://faanecuador.org"; // CHANGE THIS
const now = new Date().toISOString().split("T")[0];

const urls = paths
  .map(
    (path) => `
  <url>
    <loc>${hostname}${path}</loc>
    <lastmod>${now}</lastmod>
    <changefreq>${path === "/" ? "weekly" : "monthly"}</changefreq>
    <priority>${path === "/" ? "1.0" : "0.8"}</priority>
  </url>
`
  )
  .join("");

// 6. Write to file
const sitemap = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
${urls}
</urlset>`;

writeFileSync(resolve("./public/sitemap.xml"), sitemap);
console.log("✅ sitemap.xml generated in /public");
