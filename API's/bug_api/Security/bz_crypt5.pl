use Digest;

sub bz_crypt {
    my ($password, $salt) = @_;

    my $algorithm;
    if (!defined $salt) {
        # If you don't use a salt, then people can create tables of
        # hashes that map to particular passwords, and then break your
        # hashing very easily if they have a large-enough table of common
        # (or even uncommon) passwords. So we generate a unique salt for
        # each password in the database, and then just prepend it to
        # the hash.
        $salt = generate_random_password(8);
        $algorithm = 'SHA-256';
    }

    # We append the algorithm used to the string. This is good because then
    # we can change the algorithm being used, in the future, without 
    # disrupting the validation of existing passwords. Also, this tells
    # us if a password is using the old "crypt" method of hashing passwords,
    # because the algorithm will be missing from the string.
    if ($salt =~ /{([^}]+)}$/) {
        $algorithm = $1;
    }

    # Wide characters cause crypt and Digest to die.
    #if (Bugzilla->params->{'utf8'}) {
    #    utf8::encode($password) if utf8::is_utf8($password);
    #}

    my $crypted_password;
    if (!$algorithm) {
        # Crypt the password.
        $crypted_password = crypt($password, $salt);
    }
    else {
        my $hasher = Digest->new($algorithm);
        # Newly created salts won't yet have a comma.
        ($salt) = $salt =~ /^([^,]+),?/;
        $hasher->add($password, $salt);
        $crypted_password = $salt . ',' . $hasher->b64digest . "{$algorithm}";
    }

    # Return the crypted password.
    return $crypted_password;
}

$numArgs = $#ARGV + 1;

if ( $#ARGV != 1 ){
	#print "two argumets expected\n"; 
	exit 0;
}


$crypt_pw = bz_crypt ( $ARGV[0], $ARGV[1] );

#print "$crypt_pw\n";
#print "$ARGV[1]\n";

if ($crypt_pw eq $ARGV[1]){
	#print "OK\n";	
	exit 1; 
}

exit 0;