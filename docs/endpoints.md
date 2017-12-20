Here a list of existing endpoints used by the Vuedium SPA.

## Create a new post

In order to create posts, you need to have a valid user and token configuration in your database, in that way every post will be linked to the authenticated user. Notice, this is a stateless API, so the authenticated account is obtained every time you call the endpoints with the respective x-access-token header..

Endpoint `POST /post`
**Request**
- Header `x-access-token:{access-token}`
- Body
		`{
		title: {title},
		description: {title},
		is_published: {true|false|0|1}
		}`

- Response
	`{
		data:{
			post:{... post data}
		}
	}`

This request is atended by the `Leftaro\App\Controller\PostController` , and since you are calling a collection using the HTTP POST method, the related handler will be `PostController::postCollectionAction`.
