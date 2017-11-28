# SoftwarePackages

**SoftwarePackages** - Linking software and its usage and packages to the Kisow Foundation software database.  
Matthew R. Kisow, D.Sc. <matthew.kisow@kisow.org>  
Copyright &copy; Kisow Foundation, Inc.&reg; 2015-2017.  

The SoftwarePackages is a MediaWiki parser hook extension that is based in part on the _GentooPackages_ parser hook extension by Alex Legler.

# SoftwarePackages
A custom MediaWiki parser hook extension used to pull package or repository information from the software repository and usage database.

## Install the SoftwarePackages extension
1. From your MediaWiki extensions directory clone the _SoftwarePackages_ from this repository by typing:  
   `mkdir -p /var/www/wiki.example.com/extensions/SoftwarePackages`  
   `cd /var/www/wiki.example.com/extensions/SoftwarePackages`  
   `git clone https://github.com/DoctorKisow/SoftwarePackages.git`
2. In your MediaWiki **LocalSettings.php** configuration add the following line(s) at the end of the file:
   _wfLoadExtension( 'SoftwarePackages' );_
