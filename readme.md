# Elasticsearch

````
PUT app_index
PUT app_index/_mapping/feedback
{
  "properties": {
    "id": {
      "type": "integer"
  	},
    "user_id": {
      "type": "integer"
  	},  	
    "name": {
  	  "type": "string"
    },
    "email": {
  	  "type": "string"
    },    
	"message": {
  	  "type": "text"
  	}
  }
}
````
