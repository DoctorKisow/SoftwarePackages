# SoftwarePackages
**SoftwarePackages** - Linking software and its usage and packages to the Kisow Foundation software database.  
Matthew R. Kisow, D.Sc. <matthew.kisow@kisow.org>  
Copyright &copy; Kisow Foundation, Inc.&reg; 2015-2017.  

# Getting Started
A custom MediaWiki parser hook extension used to pull package or repository information from the software repository and usage database.

## Installation
1. From your MediaWiki extensions directory clone the _SoftwarePackages_ from this repository by typing:
```shell
     mkdir -p /var/www/wiki.example.com/extensions/SoftwarePackages  
     cd /var/www/wiki.example.com/extensions/SoftwarePackages  
     git clone https://github.com/DoctorKisow/SoftwarePackages.git
```
2. In your MediaWiki **LocalSettings.php** configuration add the following line(s) at the end of the file:
```shell
     wfLoadExtension( 'SoftwarePackages' );
```

## License
License (GPL v3.0)

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.

## Acknowledgments
**SoftwarePackages** is based in part on **GentooPackages** by Alex Legler.
