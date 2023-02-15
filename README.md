# Packt+ Assessment

## Installation & Configuration ##
First clone the GitHub repo:
```
git clone https://github.com/pcsaini/packt-assessment.git
```

Install Composer
```
composer install
```

Copy `env.example` to the save as `.env` and add the API base url
If you are using `serve` method of laravel then
```
VITE_API_BASE_URL=http://localhost:8000/api/
```
Note: You need to add your api base url

### Install Frontend
```
npm install

or

yarn install
```

If you want to use development environment then
```
npm run dev

or

yarn dev
```

If you want to use build then
```
npm run build

or

yarn build
```

Run Laravel server to access project
```
php artisan serve
```

Now you can access the project by `http://localhost:8000/`

## Admin Panel
You can access the admin panel by the url `http://localhost:8000/admin`

Use below cred to login admin panel
```
email: admin@test.com
password: password
```

## Customer Books API
```
[GET] {{base_url}}books?page=1&limit=10&sortBy=title&sortType=desc
```

Query Parameters
```
page: page number
limit: per page item
sortBy: column name for the sort
sortType: asc or desc
```

Response
```
{
    "status": true,
    "data": [
        {
            "id": 1,
            "title": "Ea corrupti voluptatem esse.",
            "isbn": 9799239082482,
            "author": "Dr. Rosendo Wehner",
            "publisher": "Thompson-Ritchie",
            "genre": "Sunt",
            "image": "https://via.placeholder.com/640x480.png/007755?text=eum",
            "description": "Fuga dolor soluta quam excepturi cupiditate laudantium hic odit. Quod totam non aliquam est. Dolor ea numquam rem similique.",
            "published": "2023-01-24",
            "created_at": "2023-02-15T17:04:56.000000Z",
            "updated_at": "2023-02-15T17:04:56.000000Z"
        },
        {
            "id": 2,
            "title": "Perspiciatis atque officiis in non deleniti voluptatibus eos perferendis sed corrupti facilis.",
            "isbn": 9796187892057,
            "author": "Jadon Dicki",
            "publisher": "Vandervort, Harber and Walsh",
            "genre": "Libero",
            "image": "https://via.placeholder.com/640x480.png/0088ee?text=eligendi",
            "description": "Dolores facere et vitae aut id sint. At qui laudantium et voluptatibus. Quam quo consequuntur distinctio similique placeat. Blanditiis in et itaque.",
            "published": "2023-02-12",
            "created_at": "2023-02-15T17:04:56.000000Z",
            "updated_at": "2023-02-15T17:04:56.000000Z"
        },
        ...
    ],
    "meta": {
        "total_page": 12,
        "current_page": 1,
        "total_item": 120,
        "per_page": 10
    },
    "link": {
        "next": true,
        "prev": false
    }
}
```
