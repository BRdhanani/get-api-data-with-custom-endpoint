const doPostBack = async (id) => {
        var user_id = id;
        // Creating the XMLHttpRequest object
        var request = new XMLHttpRequest();

        // Instantiating the request object
        request.open("GET", "https://jsonplaceholder.typicode.com/users/" + user_id);

        // Defining event listener for readystatechange event
        request.onreadystatechange = function() {
            // Check if the request is compete and was successful
            if(this.readyState === 4 && this.status === 200) {
                // Inserting the response from server into an HTML element
                var parsed_response = JSON.parse(this.responseText);
                var html = '<h2>current User</h2><br />';
                var id = 'ID : ' + parsed_response.id + '<br />';
                var name = 'Name : ' + parsed_response.name + '<br />';
                var username = 'Username : ' + parsed_response.username + '<br />';
                var email = 'Email : ' + parsed_response.name + '<br />';
                var address = 'Address : ' + parsed_response.address.suite + ', ' + parsed_response.address.street + ', ' + parsed_response.address.city + ', ' + parsed_response.address.zipcode + '<br />';
                var phone = 'Phone : ' + parsed_response.phone + '<br />';
                var website = 'Website : ' + parsed_response.name + '<br />';
                var company = 'Company Name : ' + parsed_response.company.name;
                var res = html.concat(id, name, username, email, address, phone, website, company);
                console.log(parsed_response);
                //html = '<tr><td>' + parsed_response.id + '</td><td>' + parsed_response.name + '</td><td>' + parsed_response.username + '</td><td>' + parsed_response.email + '</td><td>' + parsed_response.phone + '</td><td>' + parsed_response.website + '</td>';
                document.getElementById("result").innerHTML = res;
                console.log(JSON.parse(this.responseText).id)
            }
        };

        // Sending the request to the server
        request.send();
    }
