import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
    ],
    // Let Vite know where the source root is (where index.html is)
    // root is default to process.cwd(), which is fine.
    build: {
        outDir: 'dist', // Standard Vercel output directory
    }
});
