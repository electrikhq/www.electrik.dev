/**
 * Map Dodo product IDs → Electrik commercial tiers.
 * Defaults are live catalog; override via env COMMERCE_PRODUCT_SOLO / COMMERCE_PRODUCT_STUDIO.
 */
export function tierForProductId(productId, env = {}) {
  const solo = env.COMMERCE_PRODUCT_SOLO || 'pdt_0NmmtqGIkMmykxblitCCT';
  const studio = env.COMMERCE_PRODUCT_STUDIO || 'pdt_0NmmtqDtvSO8YszvwEmXl';
  if (productId === solo) return 'solo';
  if (productId === studio) return 'studio';
  // Legacy test-mode IDs (kept so local/test webhooks still map)
  if (productId === 'pdt_0NmHrYX3IcvoaxjhR91WX') return 'solo';
  if (productId === 'pdt_0NmHrYaV3qDKofAXKLivl') return 'studio';
  return 'unknown';
}

export const TIER_LABELS = {
  solo: 'Electrik Solo',
  studio: 'Electrik Studio',
  unknown: 'Electrik commercial license',
};
