# Structure tables
Bitrix
    id                      (bitrix)       
    member_id
    access_token
    refresh_token
    expires_token
    plan
    executed_at

Client
    id                      (client)
    bitrix                  (Bitrix > id) one to one
    app_token
    app_domain
    app_version
    executed_at

Getresponse
    id
    client                  (Client > id) one to one
    access_token
    plan
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
    list                    (Section > id > list) many to one
    entity
    bitrix
    getresponse
    executed_at

Event
    id 
    client                  (Client > id) many to one
    pipeline                (Section > id > pipeline) many to one
    type
    stage
    executed_at