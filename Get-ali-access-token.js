PlainBashC++C#CSSDiffHTML/XMLJavaJavascriptMarkdownPHPPythonRubySQL
@Test
public void testGgs() throws ApiException {
String url = "https://openapi-auth.alibaba.com";
String appkey = "";
String appSecret = "";
String apiName = "/auth/token/create";
String code = "3_500060_41aenYGsBFZ7WFK7x6OlX0VU18";
IopClient client = new IopClientImpl(url, appkey, appSecret);
IopRequest request = new IopRequest();
request.setApiName(apiName);
request.addApiParameter("code", code);
IopResponse response = client.execute(request, Protocol.GOP);
System.out.println(response.getGopResponseBody());
