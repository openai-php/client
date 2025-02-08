# Possible Changes to the Provider
When browsing across the openai-php library, I am comparing it to the python library that the
OpenAI provides and would encounter some similar properties within the OpenAI-php library.

```php
$yourApiKey = getenv('YOUR_API_KEY');

$client = OpenAI::factory()
    ->withApiKey($yourApiKey)
    ->withOrganization('your-organization') // default: null
    ->withProject('Your Project') // default: null
    ->withBaseUri('openai.example.com/v1') // default: api.openai.com/v1
    ->withHttpClient($httpClient = new \GuzzleHttp\Client([])) // default: HTTP client found using PSR-18 HTTP Client Discovery
    ->withHttpHeader('X-My-Header', 'foo')
    ->withQueryParam('my-param', 'bar')
    ->withStreamHandler(fn (RequestInterface $request): ResponseInterface => $httpClient->send($request, [
        'stream' => true // Allows to provide a custom stream handler for the http client.
    ]))
    ->make();
```

According to the documentations that Grok and Gemini provides, all we have to change 
to switch from an OpenAI call to an Grok/Gemini call is to change the BaseURL, change the model name,
and change the API keys to one provided by another provider. The code above is where we enter the base
url for the client that we define at the start of the library, so all we have to change is to add a
choice for people to choose between which client they want to enable, and select between different ones.


```php
$yourApiKey = getenv('YOUR_API_KEY');
$client = OpenAI::client($yourApiKey);

$result = $client->chat()->create([
    'model' => 'gpt-4',
    'messages' => [
        ['role' => 'user', 'content' => 'Hello!'],
    ],
]);

echo $result->choices[0]->message->content; // Hello! How can I assist you today?
```

The code here the specifies the API keys and model that we are choosing to run, so when we are changing our
model to another provider's, we can change the model and api keys right here.



# Places to Apply Change


After checking in with the library, there are several changes to the library that we can make changes to.
We can look at the library one by one: 

### Factory.php


```php
openai-php/src/Factory.php
/**
 * Creates a new Open AI Client.
 */
public function make(): Client{
    $headers = Headers::create();

    if ($this->apiKey !== null) {
        $headers = Headers::withAuthorization(ApiKey::from($this->apiKey));
    }

    if ($this->organization !== null) {
        $headers = $headers->withOrganization($this->organization);
    }

    if ($this->project !== null) {
        $headers = $headers->withProject($this->project);
    }

    foreach ($this->headers as $name => $value) {
        $headers = $headers->withCustomHeader($name, $value);
    }

    $baseUri = BaseUri::from($this->baseUri ?: 'api.openai.com/v1');

    $queryParams = QueryParams::create();
    foreach ($this->queryParams as $name => $value) {
        $queryParams = $queryParams->withParam($name, $value);
    }

    $client = $this->httpClient ??= Psr18ClientDiscovery::find();

    $sendAsync = $this->makeStreamHandler($client);

    $transporter = new HttpTransporter($client, $baseUri, $headers, $queryParams, $sendAsync);

    return new Client($transporter);
}
```
This code phrase right here creates a client for the api call, and we can see from this code that
we initialize the client from this code fracture. What we can do here potentially is to make multiple
pre-made client to make it easier. If we want to call Grok or Gemini, we can default a Grok or Gemini
client within the openai-php library with the preset baseURL to the Grok and Gemini URL so that the users 
would not have to the client basedURL to many times.



### Header.php

```php
/**
* Creates a new Headers value object, with the given organization, and the existing headers.
*/
public function withOrganization(string $organization): self
{
    return new self([
        ...$this->headers,
        'OpenAI-Organization' => $organization,
    ]);
}
```
This code snippet right here gives a newly created object a header value of Openai by default, we could possibly
change those and make sure that they are corresponding to the AI provider as they should be.






