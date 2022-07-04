( function ($) {

addEventListener("fetch", event => event.respondWith(handler(event)));

async function handler(event) {
  const req = event.request;
  const reqUrl = new URL(req.url);
  const pathPrefix = reqUrl.pathname.replace(/^(\/[^\/]+).*?$/, '$1');

  let ttlsDict = new Dictionary("ttls");
  let ttl = ttlsDict.get(pathPrefix);

  let cacheOverride = ttl ? new CacheOverride("override", { ttl }) : undefined;

  return fetch(req, {
    backend: "origin_0",
    cacheOverride
  });
}

})(jQuery)