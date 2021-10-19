import React from 'react';
import Link from 'next/link';
import client from '../lib/api/client';
const Menubar = () => {

    const handleLogout =  () => {
        client.post('auth/logout')
            .then((res) => console.log(res.data))
            .catch((err) => console.error(err));
    }

    return (
        <div className="flex-auto">
            <Link href="/posts"><a>Logo</a></Link>
            <Link href="/posts"><a>Home</a></Link>
            <button onClick={handleLogout}>Logout</button>
        </div>
    )

}

export default Menubar;