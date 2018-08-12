## Todo endpoints

Get list 
```
GET /todos
```

Get single
```
GET /todo/id
```

Update 
```
PUT /todo
{
    "id":"1", 
    "title":"title 1", 
    "body":"body 1", 
}
```

Add 
```
POST /todo
{
    "title":"title 1", 
    "body":"body 1", 
}
```

Remove
```
DELETE /todo/id
```
