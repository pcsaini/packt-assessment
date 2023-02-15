export const apiService = {
    login, logout, books, bookDetail, saveBook, deleteBook, getUserBooks
};

import axios from 'axios';
const baseUrl = import.meta.env.VITE_API_BASE_URL

function login(data) {
    return axios.post(`${baseUrl}auth/login`, data)
}

function logout() {
    return axios.get(`${baseUrl}auth/logout`)
}

function books(query) {
    return axios.get(`${baseUrl}admin/books?${query}`)
}

function bookDetail(id) {
    return axios.get(`${baseUrl}admin/books/${id}/details`)
}

function deleteBook(id) {
    return axios.delete(`${baseUrl}admin/books/${id}/delete`)
}

function saveBook(data) {
    return axios.post(`${baseUrl}admin/books`, data)
}


function getUserBooks(query) {
    return axios.get(`${baseUrl}books?${query}`)
}
