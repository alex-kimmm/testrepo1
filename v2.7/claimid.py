def claimid(arg):
  import urlparse
  url = arg
  parseURL = urlparse.urlparse(url)
  URLPathSegments = parseURL[2].split('/')
  return URLPathSegments[3]
