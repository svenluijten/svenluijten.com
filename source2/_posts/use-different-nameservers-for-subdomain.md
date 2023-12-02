---
title: Use different nameservers for a single subdomain
date: 2023-07-14
excerpt: How you can delegate nameservers for everything under a given subdomain.
extends: _layouts.post
section: body
---

For this website, I wanted a way to create so-called "review apps" so I can preview pull requests on 
`preview-<PR>.website.sven.luijten.dev`. This turns out to be a built-in feature with Vercel, but their documentation 
instructed me to point `luijten.dev`'s nameservers to theirs.

I wanted to find a way around this so that I could keep the nameservers for all my domains in Cloudflare. After a quick
Google search, I came across the `NS` record you can add to your domain. This allows you to "delegate" the nameservers 
for a given (sub)domain down to another authoritative nameserver, like Vercel's.

Since [I manage my DNS with DNSControl](./manage-your-dns-from-github-with-dnscontrol.md), I added an `NS` record for
`website.sven` pointing to Vercel's nameserver:

```js
D('luijten.dev', REG_NONE, DnsProvider(DNS_CLOUDFLARE),
    // ...

    NS('website.sven', 'ns1.vercel-dns.com.'),
    NS('website.sven', 'ns2.vercel-dns.com.')
);
```

This tells all traffic to `website.sven.luijten.dev` _and_ any subdomain (so `<anything>.website.sven.luijten.dev`) to
use Vercel's nameservers. 
