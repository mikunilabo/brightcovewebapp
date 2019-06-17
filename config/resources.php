<?php
declare(strict_types=1);

return [

    /*
     |--------------------------------------------------------------------------
     | Application resources
     |--------------------------------------------------------------------------
     |
     */

    'images' => [
        'logo' => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABWWlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS40LjAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyI+CiAgICAgICAgIDx0aWZmOk9yaWVudGF0aW9uPjE8L3RpZmY6T3JpZW50YXRpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgpMwidZAAAMF0lEQVR4Ae1cC3BVxRnePec+Eh6itIpjoCoJZWx4KDIDwUeIiu1owkidRtqZ6iAkkfAQKPKM9MrwBqO8B8KjY6cWqSIxqVYGeZNg1VYIoEAQRx5W3iBycx/nbL89ci/JzTn3nseSNhd2htlz9v//b3e/u2f33383EHIj3WDgf8kANVO5u6xiEBQXEkpOyAp5zF+U940Zu+tBR0rUydSlFWkgbxH0WhJGOikyiLyRogwkJFBxk3nQbhG1YKS/t6y8X/T9On+I+wm7yiofkgjbpsPR3uDxVvcRX05YR3ZdFRmPQJ9PAnkLDNjo4k77ocBAdl0VGxLobt+DE3SvERsgdypZ/e7NRvLrpVyfwCWVt0iMTotHAiPkp+6Qe0o8netBpkug2818nKBEBFDKRnhXlndOpJfM8kYEelZUdsHKMsxkp11MlUpN6ialWiMCGWPz0VPZQm+f8C6v/KUF/aRSbUCgZ/l7T2P0PWK1h/jcS4lvs8uqXTLoXyWwdG0qkSTuNFtPlP3Cm3apyLph87eIEuhp3WIsYewuu13CKJxKVvyjrV375mqnEZi6an0HQthEh51o62ZBn0OMZmeuEaiqrgloearT1lNCi1NWVXZ0itOc7DUCsfL+WlCjZaaQAYKwmgWMRiBaeruo1qpEvVMUVnPAibgeR9FYzIPOE2X0ZCxKaVVWqjdEpmKh6RQrs/TO6AmmsvLhOdUbKEV08v8gRQhcg7a8JKQ9El0fi+MN0WJME2Njy62/M0IlMnTx1qzK0iqSP6ZPtd86hlgL7RP2hEPz8HtedAxNyTvBIbl7Y3FUplrZ2cSa673neoLkdT1BU5dFA6resoqX8E3McdCAOikcvqfuJ6Gj3gupC4H1IEZdaaiw/58W7Op1k1QnHQL2bQ7wY00ZVv1ew/pWfRIraMr3yCJCAm38fA9ca7tyRufUDR3wtft8ShHIGwqcrpTSFdgeZo7s/fFFdLbENra+IWWEzWf4qvXFTVMaJZDk5wexAPzBZrVHg4zN5jsRkFY/johPl2rRmlPZVSvhrO+2iW9klrVka9ZAI2FTlF8lELUFCnPfw+jZaKPil0hR3mUvC3HybmlgT8njiNb091GiYgUY2UAm4AXtnbvs0/uvHnoJwLQC0YBAbkhVaQwyxSwIvIltwYK8tzxl5d3QmUI9OyaxeWTtWs/w7KptkL+tp+OgLC34vXecA3tHpo0IDBY9WYNJpcwkqqpKVBtVlEgLYKO/2uI82Xs+dTjHZFThna3jz6ISIuPj5+948Gei8KzgNCKQGwdkmZ91XEgEBKKXhQbn7faUVTyD0ZcdTx9L5hSy6v1bR2T/80hkXoynb1GWIofDsy3aCFHXJZA8/8QprJq+BDWcC1B3CVlWweefuQl0ubiNV1Gm8gfKPDNB+Lf8WVyiAxdu6v2AODxzSPoEwjag3r4Y2UEjGPh4JWTIr856KB0PHVPbQJBWyOfKYTlbLkmU8AiQ0ERlaT5Owwz7JLSyK2DGlRX1DMEl4QuKXqoJnWi9PGXpu3dhOFmZwCXGJG0HUfxw9Z8BLNYJZuz+W7f0flavwdeqzJhA1BgYkvt3bPE2xFauMjaCX+tQ3S5+BJASK4/3jiBAjmdFxVM8GCCxa+DWUDpr5Y4HWsdrg0hZXAJ/rIjFuDV0bbiw/9aUlZU5IPdpW41huLAEt6Y4Z+cu2L9pC8PYqN1lRZ1kLBYrSUhgsLD/Pvgek1Gtgk3TITkMQnECp6qG92bMtDAd++UXuSLuG/Ip4LIZI7M62OONXrL9wY5m9Z3oJSSQgwcLc2cHv/e3Dg7O7ewfmnfc2/7SCyju4qRi7GFLWpaVtxv6aPVxeIcvO8HSsfWqijJEp1x4kSkCtVrH5PsJPFayenMKOu9z3BJKbgoySQswDO+7qxSjnJMYcowbAaD068jjtcwtRzI8yysG4FNeJ6hR3+OeYdvIPcPXN/Zq55JpHoKmaXyLY7cOibIDxdnVa5oiau2y2kj06m74c6JS69Q0/+0IKx/jgKMe+/g7ZCtEgJu93OO0LssEqpSctj00dFrrdwUuRYp54FX2y4+rEkujiN1Eyi3nknRwePbO92Pt9mRMzJKp3A2bANtHuPCN/QGmrOtRO/MUx7dMoCtMPlJc2lzljm2gjffPyKAB57ndwi29R9A6OoNR1gozLfZ7NtAiJkwlODd5blh29Ru8aF/6hAxG5b/isSfIi2jZyrm9h0rFMO7OAcwvIleq46swAgNLrrw6zOgMDrBoa59C7L15NKeVQ8Cr5oxm8pd9mb62IG8THnteFTp8YuQerKMad5YJ5FWHgvQVZGedNAPjYFOwIHfd0p19bsOdnLlOsHRsw1Slq7TyQHAaclN7dR0co6IySnwqF9oikBTnnsMXNsUI3US5grlEc6SVEJkO/ZtM2JhWwRSwuPiRnQf2dHy5K6ZS3SCvabDGiudllxrtuz0CARo43moZfLf9jfETl+AwaAk//ly8uc+9cKIHJ7awpHGWumT+hRBJVl/DD60f5LUE2UD5lXu+nHkmUmKbQO67oXFG0ZoIfqMcNqdDIemPmoBq20EUiUyspPihHef2p5c8hb36oyKRgfXlqfbuRfUx7RMIFBxCfYisoj5gomeVIo6IKWDhlqzfYB58KJG+FTnw9p5mKWWHMkZ4UQ+PFAlNlLExOVt84fqgjgjkQJRJY5GZ3YJ9Hjr2rzJ+VwbDTvTCgbWIjfblbAkHSOtRaFM6b5/A9EHm4RkfxOI5JjBQ+ORBxmiDYR1bSeQdE/pI4vOp7pAWIrszUi4kp6R8ZM6ujTV3T2qHn5VHj0SmsCLT0XqAjgnkoCF3aCqf2/QqiJZRsiZckLt96UdZaTjAFx2vC2Lnwr8ELByabyk0oIpPd3H3A9MORPtS70EIgXw3oTISLyR1WWaydvsLfy47E/ULPQiHE/76sJzq2v0Zk3pgHhxUr38iHk8HFY/PCEgMgUAP3ewvQ1ajXxGd7i944tiiTb17Qf57fR3bpSeVFGU6iKPqj+ctQld1XL2Zct/XPm27qddCYQTibo2CP0Dkk3dsOhJ0tSzFFpISmc6PFTp9x7ZyEr+8tDd9cj5WNKGrOn6Jmi9qDyyP10ZxBKKWuoL+mzAQyhtUSOErDsqpW7Kt9+/gl/ERKCyhg/8+83D16qr2o1MR+xN/sM7oqHzyNyVeg4USyCuSZM25/tFTZ2R9cEje+rkfdmuJlXpOvIbYkSlEetGHS0ttUlrw+VXoqo4f5N3Mw9MwIOIn4QTWPZ/7VVBNSWcSuTd44jPt1K6FtwXfj94RvykWpYz+ZWTfndt3dxvbEvPfOIvWidQvK1TRVvVEipbjgYkANXlRvwvwrHdHdRn1OorvRYGiD9tS3XQof/MGJAlbA09U4vzhB0bpwG4HZ31lBkroimVUIT/o9ofVeZjwOxvpmClHlOU4Fory277r8E5+/tW5qSZjUj4CGwUSpbaDvNj6/YAQ2GcKdS3vXus7ZqY9N3QEMNAkI1BAO+NC8Ojw3k7hzhJRvXEV4wgVql48c0fKN7HBgjgmmigpCNyXMXkDFpJ+iTqbSA4yTuHez/wvDh+alch9iWA1ewJ58IDK9D+RDonI4fOv7Vo77RkzWMLdGDOVitTpcmTGSeB9LhITF8fy93aa/FszmM2eQHxCOMRU9baQZvpvrMPI7E/v8CUMejR7AjkD3WpnbgWPbxuzYUvSwdsinNBBTwoCOT2KLPHOBmxRZWCE4Mi4mvTJHQzEWnHSEIiA5xF8zq/G66xVGVb2VCrF38MnDYEaOV73TER8vrVKVFx9xgZiFPYx0kkqAjP3+S6hoxONOmu3HBftFkSucsRiJBWBvHOZh6e/gf3yJ7EddfKOT/n+/Z2Cz+phJB2B3K1hKhXu1iCeOevLzuMaHVYlHYF8lHQ9PL0KkfE39UaMg7J2YcXd6DQxKQnkJCnENR6j0e+AMD3T0Xt+PqFjfUHSEnglpjerfmcFPHtxPNvgykjSEsjJulB3mV8fOSqAuCgEThcH1GSU9I0UJDWBfY695keHxfx3LhHGkCPYUBp5TWoCeSexoLyFHsc9242QYSHvGvELk55ATkrmoekvwLl5Do+f4p/Zm2TcVC+F8YO8Erniq6dwo+wGA03HwH8BN5qUzQR8HNIAAAAASUVORK5CYII=",
        'logo_full' => "data:image/png;base64,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",
        'no_picture' => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAPISURBVGhD7drLy01fAMbx1/2eSzJg4FIot0RELgPlMnGduGRg8iMMKJIM/AEYKvcyMGAi18TAQAZyizJSiJRc8kO5RnyfnFWr1drn7LXX2udov+epT96zz9rn9bzv2vvsvc7b0U477VQ23TDz75fVj8qewnes0IYqx5T9XVP50prGKmkKx5TuhVEYk1N/tCQqF1N6NC7hF+zXyOMO5qDpKVp6KF7B3i+Uvk9LTphFSh+CPb6ou+iCpiektKayOzZGo9lUWvKUHoCbsMfEeomRaEmySm/ENjypbUvtLfZgHqY3MAG9EZyV8E0nX+l/zUdsR1fkyhL8hIqt0gYnMaW/4Dnu1f79Bt+4FHYhV3R2NDulKP0QOzAVvp+6jtHNuIYi79tZvmIg6qYn9Nu1dyxa+gEWICQ6Bi/C93ouTV19jx/WNtcs1I1+Ir4dQ0ufRXcUzTJ8gvu6xiMMgTID+m36xs1F3WQVlpDSeqztbvpgCuZjEgYhK3r+GezXNXbCzhX4xkUVliKldbW0BjpG3TE6Zm9Bb2v6YbgZiw+w95FjMNFMegx3jEQXltDS951tWXTWXgQ32uaeV/T4AFbjcm2bT5LCElI6hIpshZvj8I1vJFlhKau0prlOWnZG4DN84+tJWlhUbDncxJb+H+YsbFLkLix5YdkNX2JL6xi1o2PZN66eUgpPQ1ZiSr+GfWXWA7rY8I3NUsqUbnSTHlN6Nuzchm9cluSFdb9qRwsAKU9k62HnHHzjsiQvrGtZO1p8U7FUpd0rqiPwjcuSvLAu/exMhranKv0f7JyGb1yWUo5hO4NhbvFSlHbvtq7DNy5L8sLirjnp2tg8F1NaiwX9YKIz9jv4xmYppfAW2NHyiv180dInYUcLCL5x9ZRS+CrsaBHtBewxoaV1U687JTv74Y5rpJTCuuCfCDuLEbNyosfabqJbx9DpLKUUFi3LuNkEd42qaOm9sJ/Lq7TCYv9GTHRjoRsBe1xoab0XF13dLLWwVib0PuxGH67twxuYsSGlY5RaWJ5iHHzRB+1aRdTlopZt19W2uUlZuvTC8h6+pZqQpCrdlMKiM/QJDEfRpCjdtMKGrpYOYyG0yO+LrqC0tuz7z8WWbli4L3w7pqCbd93PnsdRnMENmPdXFUt9Isv1pxNaLvXt3AwpS+saYBgaZgN8L9AsqUofRO7oA+ii0yiF2NI6YerwDIrWgvVN9Ql/K2im+U50WaUvYC3Go3LxldZjba9s2qVrOm3ppahs3NL61EJ/PlHpmNKdoqyJpnGnKdtOO+1UPh0dfwDetb3LD1t/yQAAAABJRU5ErkJggg==",
    ],
];
