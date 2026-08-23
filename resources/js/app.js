import './bootstrap';
import Alpine from 'alpinejs';
import { registerDocsSearch } from './docs-search';

import.meta.glob(['../images/**']);

window.Alpine = Alpine;

registerDocsSearch(Alpine);

Alpine.start();
