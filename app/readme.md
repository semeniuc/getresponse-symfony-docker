# Structure tables
Client
    id                      (client)
    access_token
    executed_at

Bitrix
    id                      
    client                  (Client > id) one to one
    domain
    plan       
    member_id
    access_token
    refresh_token
    expires_on
    executed_at

Getresponse
    id
    client                  (Client > id) one to one
    plan
    access_token
    executed_at

Section
    id 
    client                  (Client > id) one to one
    list                    (getresponse list of sync)
    pipeline                (bitrix pipeline of sync)
    executed_at

Field
    id
    client                  (Client > id) many to one
    entity
    bitrix
    getresponse
    executed_at

Event
    id 
    client                  (Client > id) many to one
    type
    stage
    executed_at