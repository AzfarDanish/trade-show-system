# Routes

| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET, HEAD | up | - | Closure |
| GET, HEAD | register | - | Closure |
| POST | register | - | App\Http\Controllers\AuthController@register |
| GET, HEAD | / | - | Closure |
| POST | / | - | App\Http\Controllers\AuthController@login |
| POST | logout | - | App\Http\Controllers\AuthController@logout |
| GET, HEAD | admin/dashboard | - | App\Http\Controllers\AdminController@dashboard |
| GET, HEAD | admin/booths/create | - | App\Http\Controllers\BoothController@create |
| POST | admin/booths/store | - | App\Http\Controllers\BoothController@store |
| GET, HEAD | admin/booths/edit/{id} | - | App\Http\Controllers\BoothController@edit |
| PUT | admin/booths/update/{id} | - | App\Http\Controllers\BoothController@update |
| DELETE | admin/booths/delete/{id} | - | App\Http\Controllers\BoothController@destroy |
| GET, HEAD | admin/exhibitors | - | App\Http\Controllers\AdminController@exhibitors |
| GET, HEAD | admin/leads | - | App\Http\Controllers\AdminController@leads |
| GET, HEAD | admin/appointments | - | App\Http\Controllers\AdminController@appointments |
| GET, HEAD | admin/booths | - | App\Http\Controllers\AdminController@booths |
| GET, HEAD | admin/exhibitors/search | - | App\Http\Controllers\AdminController@searchExhibitors |
| GET, HEAD | admin/leads/search | - | App\Http\Controllers\AdminController@searchLeads |
| GET, HEAD | admin/booths/search | - | App\Http\Controllers\AdminController@searchBooths |
| GET, HEAD | admin/appointments/filter | - | App\Http\Controllers\AdminController@filterAppointments |
| POST | admin/shows/end | - | App\Http\Controllers\AdminController@endShow |
| GET, HEAD | admin/shows/create | - | App\Http\Controllers\AdminController@createShow |
| POST | admin/shows/store | - | App\Http\Controllers\AdminController@storeShow |
| GET, HEAD | admin/shows/edit/{id} | - | App\Http\Controllers\AdminController@editShow |
| PUT | admin/shows/update/{id} | - | App\Http\Controllers\AdminController@updateShow |
| GET, HEAD | exhibitor/dashboard | - | App\Http\Controllers\ExhibitorController@dashboard |
| GET, HEAD | exhibitor/profile/edit | - | App\Http\Controllers\ExhibitorController@edit |
| PUT | exhibitor/profile/update | - | App\Http\Controllers\ExhibitorController@update |
| GET, HEAD | exhibitor/booth | - | App\Http\Controllers\BoothController@show |
| GET, HEAD | exhibitor/leads | - | App\Http\Controllers\LeadController@index |
| GET, HEAD | exhibitor/leads/create | - | App\Http\Controllers\LeadController@create |
| POST | exhibitor/leads/store | - | App\Http\Controllers\LeadController@store |
| GET, HEAD | exhibitor/appointments | - | App\Http\Controllers\AppointmentController@index |
| GET, HEAD | exhibitor/appointments/create | - | App\Http\Controllers\AppointmentController@create |
| POST | exhibitor/appointments/store | - | App\Http\Controllers\AppointmentController@store |
| GET, HEAD | exhibitor/appointments/edit/{id} | - | App\Http\Controllers\AppointmentController@edit |
| PUT | exhibitor/appointments/update/{id} | - | App\Http\Controllers\AppointmentController@update |
| DELETE | exhibitor/appointments/delete/{id} | - | App\Http\Controllers\AppointmentController@destroy |
| GET, HEAD | exhibitor/leads/edit/{id} | - | App\Http\Controllers\LeadController@edit |
| PUT | exhibitor/leads/update/{id} | - | App\Http\Controllers\LeadController@update |
| DELETE | exhibitor/leads/delete/{id} | - | App\Http\Controllers\LeadController@destroy |
| GET, HEAD | exhibitor/leads/search | - | App\Http\Controllers\LeadController@search |
| GET, HEAD | exhibitor/profile/create | - | Closure |
| POST | exhibitor/profile/store | - | App\Http\Controllers\ExhibitorController@store |
| POST | exhibitor/join | - | App\Http\Controllers\ExhibitorController@joinShow |
| GET, HEAD | storage/{path} | storage.local | Closure |
| PUT | storage/{path} | storage.local.upload | Closure |
