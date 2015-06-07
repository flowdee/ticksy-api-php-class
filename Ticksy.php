<?php

class Ticksy {

    // API settings
    private $api_url = 'https://api.ticksy.com/v1';

    // User credentials
    private $domain;
    private $api_key;
    private $access;

    # Constructor
    public function Ticksy($domain, $api_key) {

        // Initialize
        $this->domain = $domain;
        $this->api_key = $api_key;

        // Verify
        $this->verify_credentials();
    }

    /**
     * Verify the api credentials and unlock set status
     */
    public function verify_credentials()
    {
        if ( ! isset($this->domain) ) exit('You have not set a domain yet.');
        if ( ! isset($this->api_key) ) exit('You have not set an api key yet.');

        $result = $this->call('responses-needed.json');

        if ( isset($result->error) ) return 'Username or API Key invalid.';

        $this->access = true;
    }

    /**
     * List of open tickets assigned to you
     */
    public function my_tickets()
    {
        return $this->call('my-tickets.json');
    }

    /**
     * Your responses needed
     */
    public function my_responses_needed()
    {
        return $this->call('my-responses-needed.json');
    }

    /**
     * List of all open tickets
     */
    public function open_tickets()
    {
        return $this->call('open-tickets.json');
    }

    /**
     * List of all closed tickets
     */
    public function closed_tickets()
    {
        return $this->call('closed-tickets.json');
    }

    /**
     * Comments from ticket
     */
    public function ticket_comments($id)
    {
        return $this->call('ticket-comments.json/' . $id . '/');
    }

    /**
     * All responses needed
     */
    public function responses_needed()
    {
        return $this->call('responses-needed.json');
    }

    /**
     * List of open tickets assigned to you
     */
    public function get_url($link, $id)
    {
        $links = array(
            'ticket' => 'ticket'
        );

        if ( isset($links[$link]) ) {
            return 'https://' . $this->domain . '.ticksy.com/' . $link . '/' . $id . '/';
        }

        return false;
    }

    /**
     * Verify the api credentials and unlock set status
     */
    protected function call($set)
    {
        if ( !$this->access ) {
            return false;
        }

        $url = "$this->api_url/$this->domain/$this->api_key/$set";

        $result = $this->fetch($url);

        if ( isset($result->error) ) return 'Sorry something went wrong with your request.';

        return $result;
    }

    /*
    * Either fetches the desired data from the API and caches it, or fetches the cached version
    *
    * @param string $url The url to the API call
    * @param string $set (optional) The name of the set to retrieve.
    */
    protected function fetch($url, $set = null)
    {
        $data = $this->curl($url);

        if ($data) {
            $data = isset($set) ? $data->{$set} : $data; // if a set is needed, update
        } else exit('Could not retrieve data.');

        return $data;
    }

    /**
     * General purpose function to query the ticksy API.
     *
     * @param string $url The url to access, via curl.
     * @return object The results of the curl request.
     */
    protected function curl($url)
    {
        if ( empty($url) ) return false;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; Ticksy API Wrapper PHP)');

        $data = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($data);

        return $data; // string or null
    }
}