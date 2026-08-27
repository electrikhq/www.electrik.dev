/**
 * Map Dodo product IDs → Electrik commercial tiers.
 * Test IDs are defaults; override via env COMMERCE_PRODUCT_SOLO / COMMERCE_PRODUCT_STUDIO (live).
 */
export function tierForProductId(productId, env = {}) {
  const solo = env.COMMERCE_PRODUCT_SOLO || 'pdt_0NmHrYX3IcvoaxjhR91WX';
  const studio = env.COMMERCE_PRODUCT_STUDIO || 'pdt_0NmHrYaV3qDKofAXKLivl';
  if (productId === solo) return 'solo';
  if (productId === studio) return 'studio';
  return 'unknown';
}

export const TIER_LABELS = {
  solo: 'Electrik Solo',
  studio: 'Electrik Studio',
  unknown: 'Electrik commercial license',
};
