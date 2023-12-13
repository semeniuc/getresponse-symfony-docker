# Structure tables
Client
    id                      (client_id) 
    bitrix_id
    bitrix_domain
    bitrix_plan
    getresponse_plan
    app_version
    app_instaled
    executed_at

Access 
    id 
    client                  (Client > id) one to one
    bitrix_token
    bitrix_refresh_token
    bitrix_expires_token
    getresponse_token
    app_token
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