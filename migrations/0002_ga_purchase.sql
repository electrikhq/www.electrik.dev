-- Idempotent GA4 Measurement Protocol purchase tracking
ALTER TABLE purchases ADD COLUMN ga_purchase_sent_at TEXT;
