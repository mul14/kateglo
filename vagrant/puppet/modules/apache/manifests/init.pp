class apache {

	# Define an apache2 module. Debian packages place the module config
	# into /etc/apache2/mods-available.
	define module ( $ensure = 'present' ) {
		case $ensure {
			'present' : {
				exec { "/usr/sbin/a2enmod $name":
				   creates => "/etc/apache2/mods-enabled/${name}.load",
				   notify => Exec["apache2ctl graceful"],
				   require => Package['apache2']
				}
			}
			'absent': {
				exec { "/usr/sbin/a2dismod $name":
				   onlyif => "test -f /etc/apache2/mods-enabled/${name}.load",
				   notify => Exec["apache2ctl graceful"],
				   require => Package['apache2']
				}
			}
			default: { err ( "Unknown ensure value: '$ensure'" ) }
		}
	}
   
	package { "apache2":
		ensure => present,
		require => Exec["apt-get update"]
	}

	# starts the apache2 service once the packages installed, and monitors changes to
	# its configuration files and reloads if necessary
	service { 'apache2' :
		enable    => true,
		ensure    => running,
		subscribe => [Package['apache2']]
	}

	exec{ 'apache2ctl graceful':
		refreshonly => true,
		path => '/usr/sbin',
		subscribe => [Package['apache2'], Exec['/usr/sbin/a2ensite kateglo']]
	}
	
	module { 
		["deflate", "expires", "headers", "rewrite"] :
		ensure => 'present'
	}

    file {"/etc/apache2/httpd.conf":
        content => template('apache/httpd.conf.erb'),
        owner   => 'root',
        group   => 'root',
        mode    => 0644,
        require => Package['apache2'],
        ensure => 'present',
        notify  => Exec['apache2ctl graceful'],
    }

    # ServerAdmin webmaster@localhost
    $serverAdmin = 'webmaster@kateglo.com'

    # DocumentRoot /var/www
    $documentRoot = '/home/vagrant/kateglo/public'

    # ErrorLog ${APACHE_LOG_DIR}/error.log
    $errorLog = '${APACHE_LOG_DIR}/error.log'

    # Possible values include: debug, info, notice, warn, error, crit,
    # alert, emerg.
    $logLevel = 'debug'

    file {"/etc/apache2/sites-available/kateglo":
        content => template('apache/site.erb'),
        owner   => 'root',
        group   => 'root',
        mode    => 0644,
        require => Package['apache2'],
        ensure => 'present',
        notify  => Exec['/usr/sbin/a2ensite kateglo'],
    }

    exec { "/usr/sbin/a2dissite default":
		onlyif => "test -f /etc/apache2/sites-enabled/000-default",
        notify => Exec["apache2ctl graceful"],
        require => File["/etc/apache2/sites-available/kateglo"],
    }

    exec { "/usr/sbin/a2ensite kateglo":
        require => File["/etc/apache2/sites-available/kateglo"],
        creates => '/etc/apache2/sites-enabled/kateglo',
        notify => Exec["apache2ctl graceful"],
    }
}