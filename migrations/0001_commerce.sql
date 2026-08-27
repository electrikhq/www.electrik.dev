-- Electrik commercial license ledger (Dodo Payments)
-- Applied to D1: electrik-commerce

CREATE TABLE IF NOT EXISTS webhook_events (
  webhook_id TEXT PRIMARY KEY,
  event_type TEXT NOT NULL,
  payload TEXT NOT NULL,
  processed INTEGER NOT NULL DEFAULT 0,
  error_message TEXT,
  attempts INTEGER NOT NULL DEFAULT 0,
  created_at TEXT NOT NULL DEFAULT (datetime('now')),
  processed_at TEXT
);

CREATE TABLE IF NOT EXISTS customers (
  dodo_customer_id TEXT PRIMARY KEY,
  email TEXT NOT NULL,
  name TEXT,
  created_at TEXT NOT NULL DEFAULT (datetime('now')),
  updated_at TEXT NOT NULL DEFAULT (datetime('now'))
);

CREATE INDEX IF NOT EXISTS idx_customers_email ON customers(email);

CREATE TABLE IF NOT EXISTS purchases (
  payment_id TEXT PRIMARY KEY,
  dodo_customer_id TEXT,
  email TEXT NOT NULL,
  name TEXT,
  product_id TEXT NOT NULL,
  tier TEXT NOT NULL, -- solo | studio | unknown
  status TEXT NOT NULL, -- pending | processing | succeeded | failed | cancelled | refunded
  amount INTEGER,
  currency TEXT,
  license_key TEXT,
  license_key_id TEXT,
  entitlement_grant_id TEXT,
  metadata TEXT,
  error_code TEXT,
  error_message TEXT,
  fulfilled_at TEXT,
  revoked_at TEXT,
  created_at TEXT NOT NULL DEFAULT (datetime('now')),
  updated_at TEXT NOT NULL DEFAULT (datetime('now'))
);

CREATE INDEX IF NOT EXISTS idx_purchases_email ON purchases(email);
CREATE INDEX IF NOT EXISTS idx_purchases_status ON purchases(status);
CREATE INDEX IF NOT EXISTS idx_purchases_tier ON purchases(tier);
CREATE INDEX IF NOT EXISTS idx_purchases_created_at ON purchases(created_at);

CREATE TABLE IF NOT EXISTS outbound_emails (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  payment_id TEXT,
  to_email TEXT NOT NULL,
  template TEXT NOT NULL,
  provider_message_id TEXT,
  status TEXT NOT NULL, -- queued | sent | failed
  error_message TEXT,
  created_at TEXT NOT NULL DEFAULT (datetime('now'))
);

CREATE INDEX IF NOT EXISTS idx_outbound_emails_payment ON outbound_emails(payment_id);
