import {createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        name: 'welcome',
        path: '/',
        component: () => import('../../views/pages/welcome.vue'),
        meta: {
            guest: true
        }
    },
    {
        name: 'admin',
        path: '/admin',
        redirect: '/admin/login',
        meta: {
            guest: true
        }
    },
    {
        name: 'login',
        path: '/admin/login',
        component: () => import('../../views/pages/admin/auth/login.vue'),
        meta: {
            guest: true
        }
    },
    {
        name: 'books',
        path: '/admin/books',
        component: () => import('../../views/pages/admin/books/index.vue'),
    },
    {
        name: 'user-books',
        path: '/books',
        component: () => import('../../views/pages/users/books/index.vue'),
    },
    {
        name: 'create-books',
        path: '/admin/books/create',
        component: () => import('../../views/pages/admin/books/form.vue'),
    },
    {
        name: 'edit-books',
        path: '/admin/books/:id/edit',
        component: () => import('../../views/pages/admin/books/form.vue'),
    },
    {
        name: 'dashboard',
        path: '/admin/dashboard',
        component: () => import('../../views/pages/admin/dashboard/index.vue'),
        meta: {
            authRequired: true
        }
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authRequired)) {
        if (localStorage.getItem('token') == null) {
            next({
                path: '/admin/login',
                params: { nextUrl: to.fullPath }
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (localStorage.getItem('token')) {
            next({ name: 'dashboard' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router;
