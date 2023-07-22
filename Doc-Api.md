# Examps

Resources API

Domain : localhost:8000

# - Index : (inc pagination)

-   URI : /api/examps
-   Method : GET
-   Request : {Domain}/api/examps?page=3&limit=2&column=id&sort=desc
-   Response :

                  success:
                    {
                       "status": true,
                        "code": 200,
                        "data": [
                            {
                            "id": 46,
                            "name": "Jameson Hermiston DVM",
                            "created_at": "2023-07-22T04:19:18.000000Z",
                            "updated_at": "2023-07-22T04:19:18.000000Z"
                            },
                            {
                            "id": 45,
                            "name": "Prof. Lyla Lubowitz DDS",
                            "created_at": "2023-07-22T04:19:18.000000Z",
                            "updated_at": "2023-07-22T04:19:18.000000Z"
                            }
                        ],
                        "meta": {
                            "total": 50,
                            "perPage": "2",
                            "currentPage": 3
                        }

    }
    false : {
    "status": false,
    "code": code,
    "message": "Message notification"
    }

---

# - store

-   URI : /api/examps
-   Method : POST
-   Request : {Domain}/api/examps?name=value
-   Response :

         success:
         {
            "status": true,
            "code": 201,
            "data": {
                "name": "tdev",
                "updated_at": "2023-07-22T10:14:26.000000Z",
                "created_at": "2023-07-22T10:14:26.000000Z",
                "id": 53
            }
         }

          false:
        {
            "status": false,
            "code": 400,
            "message": $validator->errors()
        }
