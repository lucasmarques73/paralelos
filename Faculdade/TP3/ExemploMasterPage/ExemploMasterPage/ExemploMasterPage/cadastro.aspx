<%@ Page Title="" Language="C#" MasterPageFile="~/PaginaMestre.Master" AutoEventWireup="true" CodeBehind="cadastro.aspx.cs" Inherits="ExemploMasterPage.cadastro" %>
<asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <h1>Página de Cadastro</h1>
    <asp:Label ID="Label1" runat="server" Text="Login"></asp:Label>
    <asp:TextBox ID="txtLogin" runat="server"></asp:TextBox>
    <br />
    <asp:Label ID="Label2" runat="server" Text="Nome"></asp:Label>
    <asp:TextBox ID="txtNome" runat="server"></asp:TextBox>
    <br />
    <asp:Label ID="Label3" runat="server" Text="E-mail"></asp:Label>
    <asp:TextBox ID="txtEmail" runat="server"></asp:TextBox>
    <br />
    <asp:Label ID="Label4" runat="server" Text="Senha"></asp:Label>
    <asp:TextBox ID="txtSenha" runat="server"></asp:TextBox>
    <br />
    <asp:Label ID="Label5" runat="server" Text="Confirma Senha"></asp:Label>
    <asp:TextBox ID="txtConfirmaSenha" runat="server"></asp:TextBox>
    <br />
    <asp:ImageButton ID="btnCadastrar" runat="server" ImageUrl="~/imagens/disk_blue_ok.png" />
    <br />
    <asp:Label ID="LabelMensagem" runat="server" Text="..."></asp:Label>
    <br />
</asp:Content>
