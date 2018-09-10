## Authentication
### Login by Appota Token

Login and get user token (login)

Demo request:
> `POST` /cms/login 
> 
> access_token=`abc`


1. **Endpoint: `/cms/login`**
2. **Method: `POST`**
3. **Params:**

    | Required params |  Type  |     Description     |
    |-----------------|--------|---------------------|
    | `access_token`  | string | Access Token |

4. **Success Response: `JSON`**

    ```javascript
    {
        "errorCode": 200,
        "message": "Success",
        "data": {
            "access_token": <string>,
            "refresh_token": <string>,
            "expired_at": <unix_timestamp>
        }
    }
    ```

    |      Params     |      Type      |                   Description                      |
    |-----------------|----------------|----------------------------------------------------|
    | `access_token`  | string         | Gamota Vip Access Token                            |
    | `refresh_token` | string         | Refresh token to automatic get new Access Token    |
    | `expired_at`    | unix_timestamp | Expired time of gv_access_token                     |

5. **Error Response: `JSON`**

    ```javascript
    {
        "errorCode": <int>,
        "message": <string>
    }
    ```

    | Error Code | Description                 |
    | :--------- | -----------                 |
    | `400`      | Bad request                 |
    | `401`      | Invalid Appota Access Token |
    | `405`      | Invalid method              |


### Logout

Log user out, invalidate refresh_token

Demo request:
> `POST` /cms/logout 
> 
> device_token=`abc`


1. **Endpoint: `/cms/logout`**
2. **Method: `POST`**
3. **Params:**

    | Required params |     Type     |      Description      |
    |-----------------|--------------|-----------------------|
    | (authenticated) | access_token | Required token header |

    | Optional params |  Type  | Description |
    |-----------------|--------|-------------|
    | `device_token`  | string | FCM token   |

4. **Success Response: `JSON`**

    ```javascript
    {
        "errorCode": 0,
        "message": "Success"
    }
    ```

5. **Error Response: `JSON`**

    ```javascript
    {
        "errorCode": <int>,
        "message": <string>
    }
    ```

    | Error Code | Description    |
    | :--------- | -----------    |
    | `400`      | Bad request    |
    | `401`      | Token invalid  |
    | `405`      | Invalid method |


### Refresh Access Token

Get new access token by refresh_token, you can only refresh a access_token with less than 30 minutes left until expiration, or you will receive same token

Demo request:
> `POST` /cms/refresh-access-token 
> 
> refresh_token=`abc`


1. **Endpoint: `/cms/refresh-access-token`**
2. **Method: `POST`**
3. **Params:**

    | Required params |  Type  |     Description     |
    |-----------------|--------|---------------------|
    | `refresh_token` | string | Valid refresh_token |

4. **Success Response: `JSON`**

    ```javascript
    {
        "errorCode": 0,
        "message": "Success",
        "data": {
            "access_token": <string>,
            "expired_at": <unix_timestamp>
        }
    }
    ```

    |      Params     |      Type      |                   Description                   |
    |-----------------|----------------|-------------------------------------------------|
    | `access_token`  | string         | New Gamota Vip Access Token                    |
    | `expired_at`    | unix_timestamp | Expired time of gv_access_token                 |

5. **Error Response: `JSON`**

    ```javascript
    {
        "errorCode": <int>,
        "message": <string>
    }
    ```

    | Error Code | Description    |
    | :--------- | -----------    |
    | `400`      | Bad request    |
    | `401`      | Unauthorized   |
    | `405`      | Invalid method |
