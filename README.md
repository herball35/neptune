# Neptune App

This is a simple rest api which providers information about pubs located near the designated location.

## Change logo

* 0.2.0 | 2016-06-21 | Added Google Place API and use of it.
* 0.1.0 | 2016-06-17 | Concept of domain model and rest api.

## How to run it?

### What is needed?

* internet connection
* vagrant
* virtual box
* rsync
* ssh

### Do it step by step

* clone project repository `git clone https://github.com/herball35/neptune.git`
* enter to project directory `cd neptune`
* run vagrant virtual machine `vagrant up`, wait for vagrant box downloading and completion of provisioning process
* get to the virtual machine through ssh by command `ssh -p 2798 vagrant@127.0.0.1` using password `vagrant`, notice vagrant may change the ssh port when it is busy on the host machine
* on the virtual machine go to `cd /var/www/neptune/` and run `composer install`, then `exit`
* add host redirection on your host machine `127.0.0.1	neptune.local`

## How to use it?

When the application server is running you can type into your browser address `http://neptune.local:8798/pubApi/doc` to see api documentation.

Or invoke one of api methods `GET http://neptune.local:8798/pubApi/neptune/pubs`, `GET http://neptune.local:8798/pubApi/pubs/54.3488976,18.653141` to see the response.

Notice vagrant may change the http port when it is busy on the host machine.

## Plans
* adding Google Places API client
* first adding redis cache then db storage
* adding unit tests and functional tests
* extend the api to possibility of paging and sorting pubs list
* adding client application
* adding varnish
* improve error handling and logging

