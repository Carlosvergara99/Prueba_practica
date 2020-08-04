import Books from './components/Books.vue';
import Author from './components/Author.vue';

export const routes = [
    {
        name: 'Authors',
        path: '/',
        component: Author
    },
    {
        name: 'Books',
        path: '/Books',
        component: Books
    }
   
]